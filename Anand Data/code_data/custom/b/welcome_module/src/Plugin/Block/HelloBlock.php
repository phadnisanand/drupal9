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
   /*return [
     '#markup' =>  $default_config->get('hello.name'),
     'form' => $form
   ];*/


        return array(
            '#theme' => 'mymodule_template',
            '#test_var' => $this->t('Test Value'),
            '#custom_name' => 'anand'
        );
  }

}