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
        'default_format' => 'filtered_html',
      ),
    ),
    'migrations' => array(
      'NodeBook' => array(
        'class_name' => 'NodeBookMigration',
        'group_name' => 'spgb_custom',
        'description' => t('Migration of D6 Book nodes'),
        'source_connection' => 'd6',
        'destination_type' => 'mt_post',
        'source_type' => 'book',
        'source_version' => 6,
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
    $query->addField('ml', 'weight', 'book_weight');
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
  }

  /**
   * Returns a mapping for a migrated book.
   *
   * @param int $source_book_nid
   *   Nid of book in source database to lookup.
   */
  protected function lookupMigratedBook($source_book_nid) {
    $dest_book_nid = parent::handleSourceMigration('NodeBook', $source_book_nid);
    return $dest_book_nid;
  }

}
