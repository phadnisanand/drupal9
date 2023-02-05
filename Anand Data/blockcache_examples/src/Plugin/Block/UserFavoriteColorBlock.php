<?php

namespace Drupal\blockcache_examples\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Provides a block to display 'Site branding' elements.
 *
 * @Block(
 *   id = "user_favorite_color_block",
 *   admin_label = @Translation("User favorite color")
 * )
 */
class UserFavoriteColorBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() { //die('hi');
    $build = array();
    $current_user_id = \Drupal::currentUser()->id();

    //print_r( $current_user_id); exit;
    // Load user object.
    $user = User::load($current_user_id);
   // print_r($user);
    $favorite_color = $user->get('field_favorite_color')->value;
    $build['rohit'] = array(
      '#markup' => 'User favorite color is ' . $favorite_color,
    );
    return $build;
  }
  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(
      parent::getCacheContexts(),
      ['user_favorite_color']
      );
  }
}