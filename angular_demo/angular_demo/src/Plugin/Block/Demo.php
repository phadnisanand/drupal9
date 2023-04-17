<?php

namespace Drupal\angular_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block to display 'Site branding' elements.
 *
 * @Block(
 *   id = "demo",
 *   admin_label = @Translation("demo block")
 * )
 */
class Demo extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
		 return [
      '#type' => 'html_tag',
      '#tag' => 'app-root', // Selector of the your app root component from the Angular app
      '#attached' => [
        'library' => [
          'angular_demo/drupal_angular_lib', // To load the library only with this block
        ],
      ],
    ];
  }
}
