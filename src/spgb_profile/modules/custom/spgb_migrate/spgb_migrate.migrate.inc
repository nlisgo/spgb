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
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'mt_post',
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
        'destination_type' => 'mt_post',
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
        'destination_type' => 'mt_post',
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
        'destination_type' => 'mt_post',
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
        'destination_type' => 'mt_post',
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
    parent::__construct($arguments);
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
      if ($this->arguments['top'] === 0) {
        // dpq($query);
      }
    }
    // dpm(preg_replace('/(\{|\})/', '', dpq($query, TRUE)));
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
