<?php

namespace Drupal\custom_slider\Plugin\Block;
use Drupal\node\Entity\Node;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a block to display 'Slider'.
 *
 * @Block(
 *   id = "custom_slider",
 *   admin_label = @Translation("Custom Slider")
 * )
 */
class Slider extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $nids = \Drupal::entityQuery('node')
    ->condition('status', 1)
    ->condition('type', 'slides')
    ->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
    $slider_data = [];
    foreach($nodes as $node) {
      $slider_data[$node->id()]['title'] = $node->get('title')->value;
      $file = \Drupal\file\Entity\File::load($node->get('field_image')->target_id);
      $media_url = \Drupal\image\Entity\ImageStyle::load('large')->buildUrl($file->getFileUri());
      $slider_data[$node->id()]['image'] = $media_url;
    }

    return [
      '#theme' => 'custom_slider',
      '#data' => $slider_data,
    ];
  }
}
