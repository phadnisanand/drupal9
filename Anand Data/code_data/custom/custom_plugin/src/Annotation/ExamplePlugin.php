<?php

namespace Drupal\custom_plugin\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Example plugin item annotation object.
 *
 * @see \Drupal\custom_plugin\Plugin\ExamplePluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class ExamplePlugin extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
