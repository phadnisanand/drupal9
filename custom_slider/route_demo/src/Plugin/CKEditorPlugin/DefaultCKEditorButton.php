<?php

namespace Drupal\route_demo\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "route_demo" plugin.
 *
 * NOTE: The plugin ID ('id' key) corresponds to the CKEditor plugin name.
 * It is the first argument of the CKEDITOR.plugins.add() function in the
 * plugin.js file.
 *
 * @CKEditorPlugin(
 *   id = "route_demo",
 *   label = @Translation("Default ckeditor button"),
 *   module = "route_demo"
 * )
 */
class DefaultCKEditorButton extends CKEditorPluginBase {

   private function getLibrariesPath() {
    $libraries_path = 'libraries/div';
    if (\Drupal::hasService('library.libraries_directory_file_finder')) {
      /** @var \Drupal\Core\Asset\LibrariesDirectoryFileFinder $library_file_finder */
      $library_file_finder = \Drupal::service('library.libraries_directory_file_finder');
      // Check primary/default path.
      $libraries_path = $library_file_finder->find('div');
      if (!$libraries_path) {
        // Check ckeditor secondary path.
        $libraries_path = $library_file_finder->find('ckeditor/plugins/div');
      }
    }
    elseif (function_exists('libraries_get_path')) {
      // Check primary/default path.
      $libraries_path = libraries_get_path('div');
      if (!$libraries_path) {
        // Check ckeditor secondary path.
        $libraries_path = libraries_get_path('ckeditor/plugins/div');
      }
    }
    return $libraries_path;
  }

  /**
   * {@inheritdoc}
   *
   * NOTE: The keys of the returned array corresponds to the CKEditor button
   * names. They are the first argument of the editor.ui.addButton() or
   * editor.ui.addRichCombo() functions in the plugin.js file.
   */
  public function getButtons() {
    // Make sure that the path to the image matches the file structure of
    // the CKEditor plugin you are implementing.

    return [
      'anand' => [
        'label' => t('anand'),
        'image' =>  $this->getLibrariesPath() . '/icons/creatediv.png',
      ],
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function isEnabled(Editor $editor) {
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {

    // Make sure that the path to the plugin.js matches the file structure of
    // the CKEditor plugin you are implementing.
    return $this->getLibrariesPath()  . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

}
