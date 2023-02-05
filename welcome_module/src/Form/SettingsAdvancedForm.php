<?php

namespace Drupal\welcome_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\node\NodeStorageInterface;

/**
 * My module advanced settings.
 */
class SettingsAdvancedForm extends ConfigFormBase {

  /**
   * Node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, NodeStorageInterface $node_storage) {
    parent::__construct($config_factory);
    $this->nodeStorage = $node_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /* @var \Drupal\Core\Entity\EntityTypeManagerInterface */
    $entityTypeManager = $container->get('entity_type.manager');

    return new static(
      $container->get('config.factory'),
      $entityTypeManager->getStorage('node')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'welcome_module_settings_advanced';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'welcome_module.settings_advanced',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $settings = $this->config('welcome_module.settings_advanced');
    
    // Normally when working with submitted data in $form_state['values'] the data is flattened 
    // and does not maintain the structure of the $form array used to generate the form. 
    // This behavior can be changed using the #tree property.
    $form['#tree'] = TRUE;

    $form['site'] = [
      '#type' => 'details',
      '#open' => TRUE,
      '#title' => $this->t('Fieldset'),
    ];
    $form['site']['title'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Site - Title'),
      '#default_value' => $settings->get('site')['title'],
    ];
    $form['site']['content'] = [
      '#type'          => 'text_format',
      '#title'         => $this->t('Site - Content'),
      '#format'        => $settings->get('site')['content']['format'],
      '#default_value' => $settings->get('site')['content']['value'],
    ];
    $form['mails'] = [
      '#type'          => 'textarea',
      '#title'         => $this->t('List of mails'),
      '#default_value' => implode('\n', $settings->get('mails')),
      '#description'   => $this->t('Every mail must be on a new line.'),
    ];
    $form['nested'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Nested'),
    ];

    $form['nested']['entity_reference'] = [
      '#type'               => 'entity_autocomplete',
      '#target_type'        => 'node',
      '#selection_settings' => [
        'target_bundles'    => ['page'],
      ],
      '#title'              => $this->t('Entity Reference'),
      '#default_value'      => $settings->get('entity_reference') ? $this->nodeStorage->load($settings->get('entity_reference')) : NULL,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $settings = $this->configFactory->getEditable('welcome_module.settings_advanced');
    
    // With the previous #tree parameter setted to TRUE
    // we can access to `site` and retreive the values of both children fields
    // and finaly store both fields as array of `site`.
    $settings->set('site', $form_state->getValue('site'))->save();

    // From string transform to array by split on new line.
    $mails = explode('\n', $form_state->getValue('mails'));
    $settings->set('mails', $mails)->save();

    // From nested array get reference.
    $entity_reference = $form_state->getValue(['nested', 'entity_reference']);
    $settings->set('entity_reference', $entity_reference)->save();
  }

}