<?php

/**
 * @file
 * Contains \Drupal\pilot\Form\BasicForm.
 */

namespace Drupal\pilot\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class BasicForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pilot_basic_form_settings';
  }

   /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'pilot.basic',
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('pilot.basic');

    $form['one'] = array(
      '#type' => 'textfield',
      '#title' => t('One'),
      '#default_value' => $config->get('one'),
    );
    $form['url'] = array(
      '#type' => 'url',
      '#title' => t('URL'),
      '#default_value' => $config->get('url'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('pilot.basic')
      ->set('one', $form_state->getValue('one'))
      ->set('url',$form_state->getValue('url'))
      ->save();

    parent::submitForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
}
