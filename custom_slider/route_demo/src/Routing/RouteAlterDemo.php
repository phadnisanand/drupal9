<?php

namespace Drupal\route_demo\Routing;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;

class RouteAlterDemo extends RouteSubscriberBase {

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  protected function alterRoutes(RouteCollection $collection) {
    $userLoginRoute = $collection->get('user.login');
    $userLoginRoute->setPath('/custom/login');
   // file_put_contents("output.txt", print_r($collection, true));
    $userRegisterRoute = $collection->get('user.register');
    $userRegisterRoute->setPath('/custom/register');

    $userPasswordRoute = $collection->get('user.pass');
    $userPasswordRoute->setPath('/custom/password');
  }
}
