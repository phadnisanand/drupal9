<?php

namespace Drupal\cache_example\Controller;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Cache\Cache;
/**
 * Example controller that we are going to use for tabs.
 */
class CacheController extends ControllerBase {

  protected $entity_manager;

  public function __construct(EntityTypeManager $entity_manager) {
   $this->entity_manager  =  $entity_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('entity_type.manager'));
  }
  /**
   * Display cached page.
   */
  public function displayData() {
    $config = \Drupal::config('cache_example.settings');
    $build = [
      '#markup' => $config->get('bio'),
      '#cache' => [
        'tags' => ['config:cache_example.settings'],
      ]
    ];
    //$renderer = \Drupal::service('renderer'); $renderer->addCacheableDependency($build, $config);
    return $build;
  }

 /**
   *  Set cached data.
   */
  public function setCacheData() {
    $cacheID = 'custom_cache_id';
    $data = [10, 20, 30];
    $tags = array('my_custom_tag');
    \Drupal::cache()->set($cacheID, $data, CacheBackendInterface::CACHE_PERMANENT, $tags);
    die('saved');
  }

   /**
   *  Get cached data.
   */
  public function getCacheData() {
    $cacheID = 'custom_cache_id';
    $cacheData =  \Drupal::cache()->get($cacheID);
    print_r($cacheData->data);
    die('done');
  }

   /**
   *  Delete cached data.
   */
  public function deleteCacheData() {
    $cacheID = 'custom_cache_id';
    \Drupal::cache()->delete($cacheID);
    die('deleted');
  }

  /**
   *  invalid cached data.
   */
  public function invalidCacheData() {
    $tags = array('my_custom_tag');
    \Drupal\Core\Cache\Cache::invalidateTags($tags);
    die('invalided');
  }

  /**
   *  get entity data.
   */
  public function getEntityData() {
    $node_storage = $this->entity_manager->getStorage('node');
    $node = $node_storage->load(1);
    $build = [
      '#markup' => $node->getTitle(),
    ];
    $renderer = \Drupal::service('renderer');
    $renderer->addCacheableDependency($build, $node);
    //Cache::invalidateTags($node->getCacheTags());
    return $build;
  }
}

