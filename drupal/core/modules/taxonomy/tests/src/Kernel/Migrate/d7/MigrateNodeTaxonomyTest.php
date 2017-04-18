<?php

namespace Drupal\Tests\taxonomy\Kernel\Migrate\d7;

use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\field\FieldStorageConfigInterface;
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

/**
 * @group taxonomy
 */
class MigrateNodeTaxonomyTest extends MigrateDrupal7TestBase {

<<<<<<< HEAD
  public static $modules = array(
=======
  public static $modules = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'datetime',
    'field',
    'filter',
    'image',
    'link',
    'node',
    'taxonomy',
    'telephone',
    'text',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('node');
    $this->installEntitySchema('taxonomy_term');
    $this->installConfig(static::$modules);
    $this->installSchema('node', ['node_access']);
    $this->installSchema('system', ['sequences']);

    $this->executeMigration('d7_node_type');

<<<<<<< HEAD
    FieldStorageConfig::create(array(
      'type' => 'entity_reference',
      'field_name' => 'field_tags',
      'entity_type' => 'node',
      'settings' => array(
        'target_type' => 'taxonomy_term',
      ),
      'cardinality' => FieldStorageConfigInterface::CARDINALITY_UNLIMITED,
    ))->save();

    FieldConfig::create(array(
      'entity_type' => 'node',
      'field_name' => 'field_tags',
      'bundle' => 'article',
    ))->save();
=======
    FieldStorageConfig::create([
      'type' => 'entity_reference',
      'field_name' => 'field_tags',
      'entity_type' => 'node',
      'settings' => [
        'target_type' => 'taxonomy_term',
      ],
      'cardinality' => FieldStorageConfigInterface::CARDINALITY_UNLIMITED,
    ])->save();

    FieldConfig::create([
      'entity_type' => 'node',
      'field_name' => 'field_tags',
      'bundle' => 'article',
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->executeMigrations([
      'd7_taxonomy_vocabulary',
      'd7_taxonomy_term',
      'd7_user_role',
      'd7_user',
      'd7_node:article',
    ]);
  }

  /**
   * Test node migration from Drupal 7 to 8.
   */
  public function testMigration() {
    $node = Node::load(2);
    $this->assertTrue($node instanceof NodeInterface);
    $this->assertEqual(9, $node->field_tags[0]->target_id);
    $this->assertEqual(14, $node->field_tags[1]->target_id);
    $this->assertEqual(17, $node->field_tags[2]->target_id);
  }

}