<?php

namespace Drupal\Tests\node\Kernel;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests node field level access.
 *
 * @group node
 */
class NodeFieldAccessTest extends EntityKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('node');
=======
  public static $modules = ['node'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Fields that only users with administer nodes permissions can change.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $administrativeFields = array(
=======
  protected $administrativeFields = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    'status',
    'promote',
    'sticky',
    'created',
    'uid',
<<<<<<< HEAD
  );
=======
  ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * These fields are automatically managed and can not be changed by any user.
   *
   * @var array
   */
<<<<<<< HEAD
  protected $readOnlyFields = array('changed', 'revision_uid', 'revision_timestamp');
=======
  protected $readOnlyFields = ['changed', 'revision_uid', 'revision_timestamp'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Test permissions on nodes status field.
   */
<<<<<<< HEAD
  function testAccessToAdministrativeFields() {
=======
  public function testAccessToAdministrativeFields() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create the page node type with revisions disabled.
    $page = NodeType::create([
      'type' => 'page',
        'new_revision' => FALSE,
    ]);
    $page->save();

    // Create the article node type with revisions disabled.
    $article = NodeType::create([
      'type' => 'article',
      'new_revision' => TRUE,
    ]);
    $article->save();

    // An administrator user. No user exists yet, ensure that the first user
    // does not have UID 1.
<<<<<<< HEAD
    $content_admin_user = $this->createUser(array('uid' => 2), array('administer nodes'));

    // Two different editor users.
    $page_creator_user = $this->createUser(array(), array('create page content', 'edit own page content', 'delete own page content'));
    $page_manager_user = $this->createUser(array(), array('create page content', 'edit any page content', 'delete any page content'));

    // An unprivileged user.
    $page_unrelated_user = $this->createUser(array(), array('access content'));

    // List of all users
    $test_users = array(
=======
    $content_admin_user = $this->createUser(['uid' => 2], ['administer nodes']);

    // Two different editor users.
    $page_creator_user = $this->createUser([], ['create page content', 'edit own page content', 'delete own page content']);
    $page_manager_user = $this->createUser([], ['create page content', 'edit any page content', 'delete any page content']);

    // An unprivileged user.
    $page_unrelated_user = $this->createUser([], ['access content']);

    // List of all users
    $test_users = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $content_admin_user,
      $page_creator_user,
      $page_manager_user,
      $page_unrelated_user,
<<<<<<< HEAD
    );

    // Create three "Basic pages". One is owned by our test-user
    // "page_creator", one by "page_manager", and one by someone else.
    $node1 = Node::create(array(
      'title' => $this->randomMachineName(8),
      'uid' => $page_creator_user->id(),
      'type' => 'page',
    ));
    $node2 = Node::create(array(
      'title' => $this->randomMachineName(8),
      'uid' => $page_manager_user->id(),
      'type' => 'article',
    ));
    $node3 = Node::create(array(
      'title' => $this->randomMachineName(8),
      'type' => 'page',
    ));
=======
    ];

    // Create three "Basic pages". One is owned by our test-user
    // "page_creator", one by "page_manager", and one by someone else.
    $node1 = Node::create([
      'title' => $this->randomMachineName(8),
      'uid' => $page_creator_user->id(),
      'type' => 'page',
    ]);
    $node2 = Node::create([
      'title' => $this->randomMachineName(8),
      'uid' => $page_manager_user->id(),
      'type' => 'article',
    ]);
    $node3 = Node::create([
      'title' => $this->randomMachineName(8),
      'type' => 'page',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    foreach ($this->administrativeFields as $field) {

      // Checks on view operations.
      foreach ($test_users as $account) {
        $may_view = $node1->{$field}->access('view', $account);
<<<<<<< HEAD
        $this->assertTrue($may_view, SafeMarkup::format('Any user may view the field @name.', array('@name' => $field)));
=======
        $this->assertTrue($may_view, SafeMarkup::format('Any user may view the field @name.', ['@name' => $field]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }

      // Checks on edit operations.
      $may_update = $node1->{$field}->access('edit', $page_creator_user);
<<<<<<< HEAD
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit own page content" is not allowed to the field @name.', array('@name' => $field)));
      $may_update = $node2->{$field}->access('edit', $page_creator_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit own page content" is not allowed to the field @name.', array('@name' => $field)));
      $may_update = $node2->{$field}->access('edit', $page_manager_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit any page content" is not allowed to the field @name.', array('@name' => $field)));
      $may_update = $node1->{$field}->access('edit', $page_manager_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit any page content" is not allowed to the field @name.', array('@name' => $field)));
      $may_update = $node2->{$field}->access('edit', $page_unrelated_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users not having permission "edit any page content" is not allowed to the field @name.', array('@name' => $field)));
      $may_update = $node1->{$field}->access('edit', $content_admin_user) && $node3->status->access('edit', $content_admin_user);
      $this->assertTrue($may_update, SafeMarkup::format('Users with permission "administer nodes" may edit @name fields on all nodes.', array('@name' => $field)));
=======
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit own page content" is not allowed to the field @name.', ['@name' => $field]));
      $may_update = $node2->{$field}->access('edit', $page_creator_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit own page content" is not allowed to the field @name.', ['@name' => $field]));
      $may_update = $node2->{$field}->access('edit', $page_manager_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit any page content" is not allowed to the field @name.', ['@name' => $field]));
      $may_update = $node1->{$field}->access('edit', $page_manager_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users with permission "edit any page content" is not allowed to the field @name.', ['@name' => $field]));
      $may_update = $node2->{$field}->access('edit', $page_unrelated_user);
      $this->assertFalse($may_update, SafeMarkup::format('Users not having permission "edit any page content" is not allowed to the field @name.', ['@name' => $field]));
      $may_update = $node1->{$field}->access('edit', $content_admin_user) && $node3->status->access('edit', $content_admin_user);
      $this->assertTrue($may_update, SafeMarkup::format('Users with permission "administer nodes" may edit @name fields on all nodes.', ['@name' => $field]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    foreach ($this->readOnlyFields as $field) {
      // Check view operation.
      foreach ($test_users as $account) {
        $may_view = $node1->{$field}->access('view', $account);
<<<<<<< HEAD
        $this->assertTrue($may_view, SafeMarkup::format('Any user may view the field @name.', array('@name' => $field)));
=======
        $this->assertTrue($may_view, SafeMarkup::format('Any user may view the field @name.', ['@name' => $field]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }

      // Check edit operation.
      foreach ($test_users as $account) {
        $may_view = $node1->{$field}->access('edit', $account);
<<<<<<< HEAD
        $this->assertFalse($may_view, SafeMarkup::format('No user is not allowed to edit the field @name.', array('@name' => $field)));
=======
        $this->assertFalse($may_view, SafeMarkup::format('No user is not allowed to edit the field @name.', ['@name' => $field]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }
    }

    // Check the revision_log field on node 1 which has revisions disabled.
    $may_update = $node1->revision_log->access('edit', $content_admin_user);
    $this->assertTrue($may_update, 'A user with permission "administer nodes" can edit the revision_log field when revisions are disabled.');
    $may_update = $node1->revision_log->access('edit', $page_creator_user);
    $this->assertFalse($may_update, 'A user without permission "administer nodes" can not edit the revision_log field when revisions are disabled.');

    // Check the revision_log field on node 2 which has revisions enabled.
    $may_update = $node2->revision_log->access('edit', $content_admin_user);
    $this->assertTrue($may_update, 'A user with permission "administer nodes" can edit the revision_log field when revisions are enabled.');
    $may_update = $node2->revision_log->access('edit', $page_creator_user);
    $this->assertTrue($may_update, 'A user without permission "administer nodes" can edit the revision_log field when revisions are enabled.');
  }

}
