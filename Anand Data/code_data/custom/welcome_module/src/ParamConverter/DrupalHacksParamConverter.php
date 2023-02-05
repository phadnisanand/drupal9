<?php

namespace Drupal\welcome_module\ParamConverter;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;
use Drupal\node\Entity\Node;
/**
 * Defines custom parameter converter.
 */
class DrupalHacksParamConverter implements ParamConverterInterface {

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults) {
   // print_r()
    return Node::load($value);
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route) {
    return (
      !empty($definition['type'])
      && ($definition['type'] == 'drupalhacks_menu')
    );
  }

}