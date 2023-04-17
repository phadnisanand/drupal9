<?php

namespace Drupal\react\Plugin\Block;

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
    $build = [];

    $build['rohit'] = [
      '#markup' => '<div id="react—app"></div>',
			'#attached' => [
        'library' => [
          'react/react_app',
        ],
      ],
    ];
    return $build;
  }
}
