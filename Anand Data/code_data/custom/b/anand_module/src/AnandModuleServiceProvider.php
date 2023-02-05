<?php

namespace Drupal\anand_module;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;
/**
 * Class AnandModuleServiceProvider.
 *
 * @package Drupal\anand_module
 */
class AnandModuleServiceProvider extends ServiceProviderBase {

  public function alter(ContainerBuilder $container) {
    $definition = $container->getDefinition('welcome_module.custom_services');
    $definition->setClass('Drupal\anand_module\AlterService');
     $definition->setArguments(
      [
        new Reference('current_user'),
      ]
    );
  }
}
