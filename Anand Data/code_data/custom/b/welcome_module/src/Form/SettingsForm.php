<?php

/**
 * @file
 * Contains Drupal\welcome_module\Form\SettingsForm.
 */

namespace Drupal\welcome_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 *
 * @package Drupal\welcome_module\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'welcome_module.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('welcome_module.settings');
    $form['first_name'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Enter First Name'),
      '#default_value' => $config->get('first_name'),
    );

    $form['last_name'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Enter Last Name'),
      '#default_value' => $config->get('last_name'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('welcome_module.settings')
      ->set('first_name', $form_state->getValue('first_name'))
      ->set('last_name', $form_state->getValue('last_name'))
      ->save();

    \Drupal::messenger()->addStatus('Form saved.');
  }

}