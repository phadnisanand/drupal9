<?php

namespace Drupal\custom_token\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

  public function content() {

  	$token_service = \Drupal::token();
  	$input = '<p>[custom_token_type:custom_token_name] [custom_token_type:absolute_url].</p>';

    $build = [
      '#markup' => $token_service->replace($input),
    ];
    return $build;
  }
	
}
