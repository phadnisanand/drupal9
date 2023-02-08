<?php
namespace Drupal\mymodule\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;


class ExampleController extends ControllerBase {

  //use StringTranslationTrait;


  /**
   * Implements Display function 
   */
  public function exampleTranslation() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, World!'),
    ];
  }
}
