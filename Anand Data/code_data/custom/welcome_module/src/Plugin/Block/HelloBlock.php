<?php

namespace Drupal\welcome_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

  $default_config = \Drupal::config('welcome_module.settings');

	 $form = \Drupal::formBuilder()->getForm('Drupal\welcome_module\Form\MymoduleExampleForm');
   return [
     '#markup' =>  $default_config->get('hello.name'),
     'form' => $form
   ];
    $random_value= rand(1000,2000);
     //$tags = array('node:1');
     // \Drupal\Core\Cache\Cache::invalidateTags($tags);
    return [
      '#type' => 'markup',
      '#markup' => $random_value,
      '#cache' => [
        'tags' => [
          // The "current user" is used above, which depends on the request,
          // so we tell Drupal to vary by the 'user' cache context.
          'node:1',
        ],
        'contexts' => [
          // The "current user" is used above, which depends on the request,
          // so we tell Drupal to vary by the 'user' cache context.
          'url',
        ],
      ],
    ];     
  }
}