<?php

/**
 * @file
 * Contains migration classes for SPGB migrate.
 */

/**
 * Implements hook_migrate_api().
 */
function spgb_migrate_migrate_api() {
  $api = array(
    'api' => 2,
    'groups' => array(
      'spgb_custom' => array(
        'title' => t('SPGB custom'),
        'default_format' => 'full_html',
      ),
    ),
    'migrations' => array(
      'NodeBookPage' => array(
        'class_name' => 'NodeBookPageMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'book',
        'source_type' => 'book',
        'source_version' => 6,
        'top' => 0,
        'dependencies' => array(),
        'parent_source_type' => 'book',
        'source_migrations' => array(
          'NodeBookPage',
        ),
      ),
      'NodeBookGroup' => array(
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book Group nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'book',
        'source_type' => 'group',
        'source_version' => 6,
        'top' => TRUE,
        'source_migrations' => array(
          'NodeBookPageGroup',
        ),
      ),
      'NodeBookPageGroup' => array(
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'book',
        'source_type' => 'book',
        'source_version' => 6,
        'top' => FALSE,
        'dependencies' => array(
          'NodeBookGroup',
        ),
        'parent_source_type' => 'group',
        'source_migrations' => array(
          'NodeBookGroup',
          'NodeBookPageGroup',
        ),
      ),
      'NodeBookPamphlet' => array(
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book Pamphlet nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'pamphlet',
        'source_type' => 'pamphlet',
        'source_version' => 6,
        'top' => TRUE,
        'source_migrations' => array(
          'NodeBookPagePamphlet',
        ),
      ),
      'NodeBookPagePamphlet' => array(
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'book',
        'source_type' => 'book',
        'source_version' => 6,
        'top' => FALSE,
        'dependencies' => array(
          'NodeBookPamphlet',
        ),
        'parent_source_type' => 'pamphlet',
        'source_migrations' => array(
          'NodeBookPamphlet',
          'NodeBookPagePamphlet',
        ),
      ),
    ),
  );
  return $api;
}

class NodeBookMigration extends DrupalNode6Migration {
  public function __construct(array $arguments) {
    // @todo - spgb - nlisgo - consider adding more d6 filter formats.
    $arguments['format_mappings'] = array(
      1 => 'filtered_html',
      2 => 'full_html',
      3 => 'filtered_html_no_automatic_line_breaks',
      4 => 'unfiltered_html',
      5 => 'plain_text',
    );
    parent::__construct($arguments);
    $this->addFieldMapping('uid', 'uid', FALSE)->sourceMigration('8f5399331User');
  }

  /**
   * Overrides parent::query to add more data to the source, in our case,
   * book hierarchy stuff.
   */
  public function query() {
    $query = parent::query();
    // Add in book parent child relationships.
    $query->join('book', 'b', 'n.nid = b.nid');
    $query->addField('b', 'bid', 'book_id');
    $query->join('menu_links', 'ml', 'b.mlid = ml.mlid');
    $query->isNotNull('ml.mlid');
    $query->addField('ml', 'mlid', 'book_mlid');
    $query->addField('ml', 'menu_name', 'book_menu_name');
    $query->addField('ml', 'weight', 'book_weight');
    if (isset($this->arguments['top'])) {
      $db_or = db_or();
      if ($this->arguments['top'] !== FALSE) {
        $db_or->condition('ml.plid', 0);
      }
      if ($this->arguments['top'] !== TRUE) {
        $db_and = db_and();
        $db_and->condition('ml.plid', 0, '>');
        $query->leftJoin('menu_links', 'pml', 'pml.mlid = ml.plid');
        if (!empty($this->arguments['parent_source_type'])) {
          $query->leftJoin('node', 'pn', "CONCAT('node/', pn.nid) = pml.link_path");
          $db_and->condition('pn.type', $this->arguments['parent_source_type']);
        }
        $db_or->condition($db_and);
      }
      $query->condition($db_or);
    }

    return $query;
  }

  /**
   * Acts right after a book node has been saved. Map the book hierarchy.
   *
   * @param object $node
   *   A node object for the newly migrated book.
   * @param stdClass $row
   *   An object representing data from the source row.
   */
  public function complete($node, stdClass $row) {
    // If this is a top-level book, don't set a parent.
    $book_id = $row->nid == $row->book_id ? $node->nid : $this->lookupMigratedBook($row->book_id);
    // Book id - effectively, parent nid.
    $node->book['bid'] = $book_id;
    $node->book['nid'] = $node->nid;
    $node->book['weight'] = $row->book_weight;

    _book_update_outline($node);
    node_save($node);

    $query = Database::getConnection('default', $this->sourceConnection)
      ->select('menu_links', 'ml')
      ->condition('ml.mlid', $row->book_mlid)
      ->condition('ml.menu_name', $row->book_menu_name);
    $query->leftJoin('menu_links', 'cml', 'cml.plid = ml.mlid');
    $query->leftJoin('menu_links', 'pml', 'pml.mlid = ml.plid');
    $query->addField('ml', 'mlid');
    $query->addExpression('SUBSTRING(cml.link_path, 6)', 'child_nid');
    $query->addExpression('SUBSTRING(pml.link_path, 6)', 'parent_nid');
    $query->addExpression("CONCAT_WS('_', ml.mlid, COALESCE(SUBSTRING(cml.link_path, 6), 0), COALESCE(SUBSTRING(pml.link_path, 6), 0))", 'id');
    if ($results = $query->execute()->fetchAllAssoc('id')) {
      $i = 0;
      foreach ($results as $result) {
        if ($i === 0 && !empty($result->parent_nid) && $dest_parent_nid = $this->lookupMigratedBook($result->parent_nid)) {
          $parent = node_load($dest_parent_nid);
          if (!empty($parent->book)) {
            $node->book['plid'] = $parent->book['mlid'];
            node_save($node);
            $parent->book['has_children'] = 1;
            node_save($parent);
          }
        }
        $i++;
        if (!empty($result->child_nid) && $dest_child_nid = $this->lookupMigratedBook($result->child_nid)) {
          $child = node_load($dest_child_nid);
          if (!empty($child->book)) {
            $child->book['plid'] = $node->book['mlid'];
            node_save($child);
          }
        }
      }
    }
  }

  public function postImport() {
    // Unpublish unresolved stub nodes.
    // All nodes that are stubs after migration are because of redundant entries
    // in the menu_links table of the source db.
    $query = db_select('node', 'n')
      ->condition('title', 'Stub');
    $query->addField('n', 'nid');
    if ($results = $query->execute()->fetchAllAssoc('nid')) {
      foreach (array_keys($results) as $nid) {
        $node = node_load($nid);
        $node->status = 0;
        node_save($node);
      }
    }

    /*
     * Some useful queries.
     *
     * SELECT nid FROM spgb.node WHERE title LIKE '%stub%';
     * SELECT sourceid1 FROM migrate_map_nodebookpage WHERE destid1 IN (SELECT nid FROM spgb.node WHERE title LIKE '%stub%');
     * SELECT * FROM spgb_d6.node WHERE nid IN (SELECT sourceid1 FROM migrate_map_nodebookpage WHERE destid1 IN (SELECT nid FROM spgb.node WHERE title LIKE '%stub%'));
     * SELECT mlk_c.menu_name, mlk_c.mlid, mlk_c.plid, mlk_c.link_title, mlk_c.module, mlk_c.depth, node_s.nid, node_s.title, node_s.status, mlk_p.link_path AS plid_link_path, mlk_p.link_title AS plid_link_title FROM spgb_d6.menu_links mlk_c, spgb_d6.menu_links mlk_p, (SELECT sourceid1 FROM migrate_map_nodebookpage WHERE destid1 IN (SELECT nid FROM spgb.node WHERE title LIKE '%stub%')) AS map LEFT JOIN spgb_d6.node node_s ON node_s.nid = map.sourceid1 WHERE CONCAT('node/', map.sourceid1) = mlk_c.link_path AND mlk_p.mlid = mlk_c.plid;
     * SELECT stub.*, CONCAT(SUBSTRING_INDEX(stub.link_path, '/', -1), ',', GROUP_CONCAT(dupl_node.nid)) FROM (SELECT mlk_c.mlid, mlk_c.link_title, mlk_c.link_path FROM spgb_d6.menu_links mlk_c, spgb_d6.menu_links mlk_p, (SELECT sourceid1 FROM migrate_map_nodebookpage WHERE destid1 IN (SELECT nid FROM spgb.node WHERE title LIKE '%stub%')) AS map LEFT JOIN spgb_d6.node node_s ON node_s.nid = map.sourceid1 WHERE CONCAT('node/', map.sourceid1) = mlk_c.link_path AND mlk_p.mlid = mlk_c.plid) AS stub LEFT JOIN spgb_d6.node dupl_node ON dupl_node.title = stub.link_title AND CONCAT('node/', dupl_node.nid) != stub.link_path GROUP BY dupl_node.title ORDER BY dupl_node.title;
     */
  }

  /**
   * Returns a mapping for a migrated book.
   *
   * @param int $source_book_nid
   *   Nid of book in source database to lookup.
   */
  protected function lookupMigratedBook($source_book_nid) {
    $dest_book_nid = parent::handleSourceMigration($this->arguments['source_migrations'], $source_book_nid);
    return $dest_book_nid;
  }
}

class NodeBookPageMigration extends NodeBookMigration {
  public function __construct(array $arguments) {
    parent::__construct($arguments);
    $this->addFieldMapping('field_date', 'field_pubdate');
    $this->addFieldMapping('field_tr_author_speaker', '3')->sourceMigration('8f5399331Term3');
    $this->addFieldMapping('field_tr_author_speaker:source_type')
      ->defaultValue('tid');
    $this->addFieldMapping('field_tr_subject', '2')->sourceMigration('8f5399331Term2');
    $this->addFieldMapping('field_tr_subject:source_type')
      ->defaultValue('tid');
    $this->addFieldMapping('field_lead_image', 'field_image')->sourceMigration('8f5399331File');
    $this->addFieldMapping('field_lead_image:file_class')
      ->defaultValue('MigrateFileFid');
    $this->addFieldMapping('field_lead_image:preserve_files')
      ->defaultValue(TRUE);
    $this->addFieldMapping('field_full_page_image', 'field_fullpageimage')->sourceMigration('8f5399331File');
    $this->addFieldMapping('field_full_page_image:file_class')
      ->defaultValue('MigrateFileFid');
    $this->addFieldMapping('field_full_page_image:preserve_files')
      ->defaultValue(TRUE);
    $this->addFieldMapping('field_inline_image', 'field_imageinline')->sourceMigration('8f5399331File');
    $this->addFieldMapping('field_inline_image:file_class')
      ->defaultValue('MigrateFileFid');
    $this->addFieldMapping('field_inline_image:preserve_files')
      ->defaultValue(TRUE);
    $this->addFieldMapping('field_pdf', 'field_pdf')->sourceMigration('8f5399331File');
    $this->addFieldMapping('field_pdf:file_class')
      ->defaultValue('MigrateFileFid');
    $this->addFieldMapping('field_pdf:preserve_files')
      ->defaultValue(TRUE);
  }

  public function prepareRow($row) {
    if (!empty($row->body)) {
      $row->body = preg_replace('~(src=\")http://www.worldsocialism.org~', '$1', $row->body);
    }
    parent::prepareRow($row);
  }
}
