<?php

namespace Drupal\exchange_rate\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Configure Exchange Rate settings for this site.
 */
class ExchangeRateSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'exchange_rate_exchange_rate_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['exchange_rate.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\Core\Config\Config $config */
    $config = $this->config('exchange_rate.settings');
    $form['endpoint'] = [
      '#type' => 'url',
      '#title' => $this->t('Webservice endpoint'),
      '#default_value' => $config->get('endpoint'),
      '#required' => TRUE,
      '#size' => 110,
    ];
    $form['token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Celsius'),
      '#default_value' => $config->get('token'),
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('exchange_rate.settings')
      ->set('endpoint', $form_state->getValue('endpoint'))
      ->set('token', $form_state->getValue('token'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
