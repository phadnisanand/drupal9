<?php

/**
 * @file
 * Definition of Drupal\mymodule\Plugin\views\field\NodeTypeFlagger
 */

namespace Drupal\mymodule\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("product_total")
 */
class ProductTotal extends FieldPluginBase {

  /**
   * @{inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }

  /**
   * Define the available options
   * @return array
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['node_type'] = array('default' => 'product');
    return $options;
  }


  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    $node = $this->getEntity($values);
    if ($node->bundle() == $this->options['node_type']) {
      $sum = $node->field_price1->value + $node->field_price_2->value + $node->field_price_3->value;
      return $sum;
    }
    else {
      return 0;
    }
  }
}