<?php
/**
 * Created by PhpStorm.
 * User: Zhilevan
 * Date: 1/9/18
 * Time: 23:38
 */

namespace Drupal\welcome_module\TwigExtension;


class RemoveNumbers extends \Twig_Extension {    

  /**
   * Generates a list of all Twig filters that this extension defines.
   */
  public function getFilters() {
    return [
      new \Twig_SimpleFilter('removenum', array($this, 'removeNumbers')),
    ];
  }

  /**
   * Gets a unique identifier for this Twig extension.
   */
  public function getName() {
    return 'welcome_module.twig_extension';
  }

  /**
   * Replaces all numbers from the string.
   */
  public static function removeNumbers($string) {
    return preg_replace('#[0-9]*#', '', $string);
  }

}