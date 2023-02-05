<?php
namespace Drupal\blockcache_examples\CacheContext;

use Drupal\Core\Cache\Context\CacheContextInterface;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\user\Entity\User;
class UserFavoriteColorCacheContext implements CacheContextInterface { 
  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  public function __construct(AccountProxyInterface $current_user) { 
      $this->currentUser = $current_user;
  }
  /**
   * {@inheritdoc}
   */
  public static function getLabel() {
    return t('User favorite color cache context');
  }
  /**
  * {@inheritdoc}
  */
  public function getContext() { //die('hgi');
    $current_user_id = \Drupal::currentUser()->id();

    //print_r( $current_user_id); exit;
    // Load user object.
    $user = User::load($current_user_id);
   // print_r($user);
    $favorite_color = $user->get('field_favorite_color')->value;
    return $favorite_color;
  }
  /**
  * {@inheritdoc}
  */
  public function getCacheableMetadata() {
    return new CacheableMetadata();
  }
}