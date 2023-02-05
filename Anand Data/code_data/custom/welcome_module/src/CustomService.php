<?php

namespace Drupal\welcome_module;

use Drupal\Core\Session\AccountInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Http\ClientFactory;
use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Path\PathValidator;
use Drupal\Core\Entity\EntityTypeManager;
/**
 * Class CustomService
 * @package Drupal\welcome_module\Services
 */
class CustomService {

  protected $currentUser;

  /**
   * CustomService constructor.
   * @param AccountInterface $currentUser
   */
  public function __construct(AccountInterface $currentUser,ClientFactory $http_client_factory,LanguageManager $language,
    CurrentRouteMatch $route, CurrentPathStack $currentPath,PathValidator $path,EntityTypeManager $entity_manager) {
    $this->currentUser = $currentUser;
    $this->http_client_factory = $http_client_factory;
    $this->language = $language;
    $this->route  = $route;
    $this->currentPath = $currentPath;
    $this->path = $path;
    $this->entity_manager = $entity_manager;
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData() {// die('coming');
    //return $this->currentUser->getDisplayName();

    /*$node_storage = $this->entity_manager->getStorage('node');
    $node = $node_storage->load(1);
    echo $node->title->value;  
    exit;*/
    $client = $this->http_client_factory->fromOptions([
      'base_uri' => 'https://jsonplaceholder.typicode.com/',
    ]);

    $response = $client->get('posts', [
      'query' => [
        'amount' => 2,
      ]
    ]);

    $json_data = Json::decode($response->getBody());
   
    $items = [];

    foreach ($json_data as $json) {
      $items[] = $json_data;
    }
    /*$current_path = $this->currentPath->getPath();
    $url_object= $this->path->getUrlIfValid($current_path);
    $route_parameters = $url_object->getrouteParameters();

    print_r($current_path);*/
     //$default_language= 'en';
    /*$language_list =$this->language->getStandardLanguageList();
    print_r($language_list);
    exit;*/

    return $items;
  }
}