<?php

namespace Drupal\welcome_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module basic settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'welcome_module_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'welcome_module.simple_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $settings = $this->config('welcome_module.simple_settings');

    $form['example'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Fieldset'),
    ];

    $form['example']['title'] = [
      '#type'          => 'textfield',
      '#default_value' => $settings->get('title'),
    ];

    $form['fruits'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Fruits'),
    ];

    $form['fruits']['select'] = [
      '#type'          => 'select',
      '#options'       => ['strawberry' => $this->t('Strawberry'), 'banana' => $this->t('Banana')],
      '#default_value' => $settings->get('select'),
    ];

    $form['home'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Home'),
    ];

    $form['home']['checkbox'] = [
      '#type'          => 'checkbox',
      '#title'         => 'Light me up',
      '#default_value' => $settings->get('checkbox'),
    ];

    $form['brands'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Brands'),
    ];

    $form['brands']['checkboxes'] = [
      '#type'          => 'checkboxes',
      '#options'       => ['apple' => $this->t('Apple'), 'microsoft' => $this->t('Microsoft')],
      '#default_value' => $settings->get('checkboxes'),
    ];

    $form['energy'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Energy'),
    ];

    $form['energy']['radios'] = [
      '#type'          => 'radios',
      '#options'       => ['coffee' => $this->t('Coffee'), 'tea' => $this->t('Tea')],
      '#default_value' => $settings->get('radios'),
    ];

    $form['texts'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Texts'),
    ];

    $form['texts']['message'] = [
      '#type'          => 'textarea',
      '#default_value' => $settings->get('message'),
    ];

    $form['texts']['ckeditor'] = [
      '#type'          => 'text_format',
      '#format'        => $settings->get('ckeditor')['format'],
      '#default_value' => $settings->get('ckeditor')['value'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $settings = $this->configFactory->getEditable('welcome_module.simple_settings');

    // Save configurations.
    $settings->set('title', $form_state->getValue('title'))->save();
    $settings->set('select', $form_state->getValue('select'))->save();
    $settings->set('radios', $form_state->getValue('radios'))->save();
    $settings->set('checkbox', $form_state->getValue('checkbox'))->save();
    $settings->set('checkboxes', $form_state->getValue('checkboxes'))->save();
    $settings->set('message', $form_state->getValue('message'))->save();
    $settings->set('ckeditor', $form_state->getValue('ckeditor'))->save();
  }

}