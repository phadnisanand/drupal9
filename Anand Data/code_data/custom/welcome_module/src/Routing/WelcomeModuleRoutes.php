<?php

namespace Drupal\welcome_module\Routing;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Route;

/**
 * Class WelcomeModuleRoutes
 * @package Drupal\welcome_module\Routing
 */
class WelcomeModuleRoutes implements ContainerInjectionInterface {

  /**
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * WelcomeModuleRoutes constructor.
   * @param ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('welcome_module.settings');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function routes()
  {
    $routes = [];
    
    $first_name = $this->config->get('first_name');
    $path = '/welcome_module/{first_name}' ;
    //echo $first_name; exit;
    $routes['welcome_module.page_' . $first_name] = new Route(
      $path,
      [
        '_controller' => '\Drupal\welcome_module\Controller\WelcomeController::index',
        '_title' => 'Hello',
      ],
      [
        '_permission' => 'access content',
      ],
      //'Defaults' => ('page' => 1)
    );

    //$routes['welcome_module.page_' . $first_name]->defaults(['page' => 1]);
    //print_r($routes); exit;
    return $routes;
  }


}