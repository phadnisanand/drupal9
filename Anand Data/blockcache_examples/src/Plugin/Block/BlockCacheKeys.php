<?php

namespace Drupal\blockcache_examples\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a Block
 *
 * @Block(
 *   id = "block_cache_keys",
 *   admin_label = @Translation("Block caching with cache key example"),
 * )
 */
class BlockCachekeys extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {

    return [
      'simple_alert_10' => [
          '#markup' => 'Temporary by 10 seconds ' . time() . '<br>',
          '#cache' => [
            'max-age' => 10,
            'keys' =>  ['simple_alert_10']
          ]
      ],
      'simple_alert_20' => [
         '#markup' => 'Temporary by 20 seconds ' . time() . '<br>',
         '#cache' => [
            'max-age' => 20,
            'keys' =>  ['simple_alert_20']
          ]
      ]
    ];
  }

//  /**
//   * Example 1: Individual node
//   */
  /*public function getCacheTags() { //die('coming');
    return Cache::mergeTags(parent::getCacheTags(), array('node:1'));
  }*/

//  /**
//   * Example 2: When any node is updated
//   */
/* public function getCacheTags() { //print_r(parent::getCacheTags()); exit;
    return Cache::mergeTags(parent::getCacheTags(), array('node_list'));
  }*/

//  /**
//   * Example 3 (custom): Only when node(s) of type 'page' are updated. See .module file
//   */
   /*public function getCacheTags() {
     return Cache::mergeTags(parent::getCacheTags(), array('blockcache_examples_page_updates'));
   }*/

}

