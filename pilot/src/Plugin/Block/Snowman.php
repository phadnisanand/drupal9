<?php

/**
 * @file
 * Contains \Drupal\pilot\Plugin\Block\Snowman.
 */

namespace Drupal\pilot\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'Snowman' block.
 *
 * @Block(
 *   id = "pilot_snowman",
 *   admin_label = @Translation("Indifferent Snowman")
 * )
 */
class Snowman extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array('#markup' => '<span style="font-size:12em;"">☃</span>');
  }
}
