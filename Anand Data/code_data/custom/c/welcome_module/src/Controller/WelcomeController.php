<?php

namespace Drupal\welcome_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\welcome_module\CustomService;
use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Routing\CurrentRouteMatch;
/**
 * Defines WelcomeController class.
 */
class WelcomeController extends ControllerBase {
   protected $configFactory;

   public static function create(ContainerInterface $container) {
    return new static($container->get('config.factory'), $container->get('welcome_module.custom_services'),$container->get('language_manager'),
      $container->get('current_route_match'), $container->get('path.current'));
  }

  public function __construct(ConfigFactory $config_factory, CustomService $custom_service,LanguageManager $language,CurrentRouteMatch $route,CurrentPathStack $currentPath) {
    $this->configFactory  =  $config_factory;
    $this->custom_service = $custom_service;
    $this->language = $language;
    $this->currentPath =$currentPath;
  }
  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {

    /*$current_path = $this->currentPath->getPath();
    echo $current_path;
    die();*/
    $config = $this->configFactory->getEditable('welcome_module.settings');
    $first_name= $config->get('first_name');
    $last_name = $config->get('last_name');
    $data = $this->custom_service->getData();
    //print_r($data);exit;
    /*$nid = 1;     // example value
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $node = $node_storage->load($nid);
    echo $node->title->value;  
     exit;*/
    /*return [
      '#type' => 'markup',
      '#markup' => 'Hi ' . $first_name . ' ' . $last_name . '  ' . 'new ' . $data ,
    ];*/
//echo '<pre>'; print_r($data[0][0]); exit;

    return array(
            '#theme' => 'mymodule_controller_template',
            '#myvariable' => $data[0],
          
        );

  }

}