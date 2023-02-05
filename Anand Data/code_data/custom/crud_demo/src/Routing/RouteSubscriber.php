<?php

namespace Drupal\crud_demo\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class RouteSubscriber
 * @package Drupal\crud_demo
 */
class RouteSubscriber extends RouteSubscriberBase {

  public function __construct() {}
  /**
   * @param RouteCollection $collection
   */
  public function alterRoutes(RouteCollection $collection) {

    // Disable access to the registration page.
    if ($route = $collection->get('crud_demo.list_data')) {
      //$route->setRequirement('_access', 'FALSE');
      $route->setDefault('_controller', '\Drupal\crud_demo\Controller\ListArticlesController::updatedlistArticles');
    }

    // Remove user password reset page.
    /*if ($route = $collection->get('user.pass')) {
      $route->setRequirement('_access', 'FALSE');
    }*/

  }

}