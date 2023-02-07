<?php

namespace Drupal\customblock\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\customblock\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Class CustomForm.
 */
class CustomForm extends FormBase {

  protected $custom_service;
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }

   public function __construct( CustomService $custom_service) {
    $this->custom_service = $custom_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('customblock.custom_services')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#autocomplete_route_name' => 'customblock.autocomplete',
      '#autocomplete_route_parameters' => array('city' => 'title'),
      '#ajax' => [
        'callback' => [$this, 'submitFormData'],
        'event' => 'change',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  public function submitFormData(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $city= $form_state->getValue('title');
    $data= $this->custom_service->getData($city);
    //print_r($data); exit;
    $ajax_response->addCommand(new HtmlCommand('#temp', $data['temp']));
    $ajax_response->addCommand(new HtmlCommand('#feels_like', $data['feels_like']));
    $ajax_response->addCommand(new HtmlCommand('#temp_min', $data['temp_min']));
    $ajax_response->addCommand(new HtmlCommand('#temp_max', $data['temp_max']));
    $ajax_response->addCommand(new HtmlCommand('#location', $data['location']));
    return $ajax_response;

  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    /*print_r($form_state->getValue('title'));
    die('coming');
    exit;*&/
 
    // $title  = $form_state->getValue('title');
    //\Drupal::state()->set('search_keyword',$title);
    /*$path = \Drupal\Core\Url::fromRoute('customblock.list', ['formdata' => $form_state->getValues()])->toString();
    $response = new RedirectResponse($path);
    $response->send();*/

   // print_r($form_state->getValue('title')); exit;
    /*$form_state->setRedirect('customblock.list',[
    'title' => $form_state->getValue('title'),
  ]);*/

    //\Drupal::messenger()->addMessage($title);
    // Display result.
    /*foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }*/
  }

}