<?php

namespace Drupal\Tests\taxonomy\Kernel\Migrate\d6;

use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Tests\migrate_drupal\Kernel\d6\MigrateDrupal6TestBase;

/**
 * Vocabulary entity form display migration.
 *
 * @group migrate_drupal_6
 */
class MigrateVocabularyEntityFormDisplayTest extends MigrateDrupal6TestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['taxonomy'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->migrateTaxonomy();
  }

  /**
   * Tests the Drupal 6 vocabulary-node type association to Drupal 8 migration.
   */
  public function testVocabularyEntityFormDisplay() {
    // Test that the field exists.
    $component = EntityFormDisplay::load('node.page.default')->getComponent('tags');
    $this->assertIdentical('options_select', $component['type']);
    $this->assertIdentical(20, $component['weight']);
    // Test the Id map.
<<<<<<< HEAD
    $this->assertIdentical(array('node', 'article', 'default', 'tags'), $this->getMigration('d6_vocabulary_entity_form_display')->getIdMap()->lookupDestinationID(array(4, 'article')));
=======
    $this->assertIdentical(['node', 'article', 'default', 'tags'], $this->getMigration('d6_vocabulary_entity_form_display')->getIdMap()->lookupDestinationID([4, 'article']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Test the term widget tags setting.
    $entity_form_display = EntityFormDisplay::load('node.story.default');
    $this->assertIdentical($entity_form_display->getComponent('vocabulary_1_i_0_')['type'], 'options_select');
    $this->assertIdentical($entity_form_display->getComponent('vocabulary_2_i_1_')['type'], 'entity_reference_autocomplete_tags');
  }

}
