<?php
namespace Drupal\pilot\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\pilot\Plugin\Person\Dave;

class WelcomeController extends ControllerBase {

  public function displayData() {//die('coming');
  $manager = \Drupal::service('plugin.manager.pilot.person');
 // Create a class instance through the manager.
  $instance = $manager->createInstance('dave');

  $type = \Drupal::service('plugin.manager.pilot.person');
  //print_r( $type); exit;
  $plugin_definitions = $type->getDefinitions();
  $plugin_definition = $type->getDefinition('dave');
  //print_r($plugin_definition->getName() ); exit;
  //$person = ["id"=>1,"name"=>'anand',"age" => 36];
    //$obj = new Dave($);
    return [
      '#type' => 'markup',
      '#markup' => $instance->greeting(),
    ];
  }
}
