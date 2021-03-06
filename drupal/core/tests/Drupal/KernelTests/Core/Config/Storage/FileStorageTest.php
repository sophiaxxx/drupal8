<?php

namespace Drupal\KernelTests\Core\Config\Storage;

<<<<<<< HEAD
use Drupal\Component\Serialization\Yaml;
use Drupal\Core\Config\FileStorage;
use Drupal\Core\Config\UnsupportedDataTypeConfigException;
=======
use Drupal\Core\Config\FileStorage;
use Drupal\Core\Config\UnsupportedDataTypeConfigException;
use Drupal\Core\Serialization\Yaml;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Core\StreamWrapper\PublicStream;

/**
 * Tests FileStorage operations.
 *
 * @group config
 */
class FileStorageTest extends ConfigStorageTestBase {

  /**
   * A directory to store configuration in.
   *
   * @var string
   */
  protected $directory;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Create a directory.
    $this->directory = PublicStream::basePath() . '/config';
    $this->storage = new FileStorage($this->directory);
    $this->invalidStorage = new FileStorage($this->directory . '/nonexisting');

    // FileStorage::listAll() requires other configuration data to exist.
    $this->storage->write('system.performance', $this->config('system.performance')->get());
<<<<<<< HEAD
    $this->storage->write('core.extension', array('module' => array()));
=======
    $this->storage->write('core.extension', ['module' => []]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  protected function read($name) {
    $data = file_get_contents($this->storage->getFilePath($name));
    return Yaml::decode($data);
  }

  protected function insert($name, $data) {
    file_put_contents($this->storage->getFilePath($name), $data);
  }

  protected function update($name, $data) {
    file_put_contents($this->storage->getFilePath($name), $data);
  }

  protected function delete($name) {
    unlink($this->storage->getFilePath($name));
  }

  /**
   * Tests the FileStorage::listAll method with a relative and absolute path.
   */
  public function testlistAll() {
<<<<<<< HEAD
    $expected_files = array(
      'core.extension',
      'system.performance',
    );
=======
    $expected_files = [
      'core.extension',
      'system.performance',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $config_files = $this->storage->listAll();
    $this->assertIdentical($config_files, $expected_files, 'Relative path, two config files found.');

    // @todo https://www.drupal.org/node/2666954 FileStorage::listAll() is
    //   case-sensitive. However, \Drupal\Core\Config\DatabaseStorage::listAll()
    //   is case-insensitive.
    $this->assertIdentical(['system.performance'], $this->storage->listAll('system'), 'The FileStorage::listAll() with prefix works.');
    $this->assertIdentical([], $this->storage->listAll('System'), 'The FileStorage::listAll() is case sensitive.');
  }

  /**
   * Test UnsupportedDataTypeConfigException displays path of
   * erroneous file during read.
   */
  public function testReadUnsupportedDataTypeConfigException() {
    file_put_contents($this->storage->getFilePath('core.extension'), PHP_EOL . 'foo : [bar}', FILE_APPEND);
    try {
      $config_parsed = $this->storage->read('core.extension');
    }
    catch (UnsupportedDataTypeConfigException $e) {
      $this->pass('Exception thrown when trying to read a field containing invalid data type.');
      $this->assertTrue((strpos($e->getMessage(), $this->storage->getFilePath('core.extension')) !== FALSE), 'Erroneous file path is displayed.');
    }
  }

}
