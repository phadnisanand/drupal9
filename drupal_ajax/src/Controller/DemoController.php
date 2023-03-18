<?php

namespace Drupal\drupal_ajax\Controller;
use Spatie\SimpleExcel\SimpleExcelReader;
use Drupal\Core\Controller\ControllerBase;
/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

/**
 * Defines popup content.
 */
public function content() {
  return [
     '#markup' => "<a href='#' id='click_me'>click here</a><a href='#' id='click_me2'>click here2</a>",
    ];
  }
}
