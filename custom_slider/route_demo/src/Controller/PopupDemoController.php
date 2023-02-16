<?php

namespace Drupal\route_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
/**
 * Defines PopupDemoController class.
 */
class PopupDemoController extends ControllerBase {

/**
 * Defines popup content.
 */
public function content() {

  $markup = '<a class="use-ajax" data-dialog-type="modal" href="http://localhost/www/drupal/popupform">Modal link</a>';

  return [
     '#markup' => $markup,
    ];
  }
}
