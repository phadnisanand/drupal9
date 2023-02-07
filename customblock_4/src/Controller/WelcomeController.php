<?php
namespace Drupal\customblock\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Connection;
use Drupal\Core\Config\ConfigFactory;
use Drupal\customblock\CustomService;
use Drupal\Component\Utility\Tags;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Unicode;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\HtmlCommand;

class WelcomeController extends ControllerBase implements ContainerInjectionInterface {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  protected $entityQuery;

  protected $db;

  protected $configFactory;

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

  public function displayData() {
    //$formdata =\Drupal::request()->query->all();
   // $title=  $formdata['title'];
    //$title= \Drupal::state()->get('search_keyword');
    //echo  $title; exit;
    $weather_data = [];
    /*if(!empty($title)) {
       $weather_data= $this->custom_service->getData($title);
    }*/
      return array(
            '#theme' => 'weather_controller_template',
            '#data' => $weather_data,
            '#cache' => ['max-age' => 0],
        );

  }

  /*public function ajaxResponse(Request $request) { 
    $json_string = \Drupal::request()->getContent();
    $decoded = \Drupal\Component\Serialization\Json::decode($json_string); 
    $search_term= $decoded['title'];
    $weather_data= $this->custom_service->getData($search_term);
    return new JsonResponse($weather_data);
  }*/

  public function ajaxResponse($title) {  //echo $title; exit;
    $ajax_response = new AjaxResponse();
   // $city= $form_state->getValue('title');
    $data= $this->custom_service->getData($title);
    //print_r($data); exit;
    $ajax_response->addCommand(new HtmlCommand('#temp', $data['temp']));
    $ajax_response->addCommand(new HtmlCommand('#feels_like', $data['feels_like']));
    $ajax_response->addCommand(new HtmlCommand('#temp_min', $data['temp_min']));
    $ajax_response->addCommand(new HtmlCommand('#temp_max', $data['temp_max']));
    $ajax_response->addCommand(new HtmlCommand('#location', $data['location']));
    return $ajax_response;
  }

  /**
   * Handler for autocomplete request.
   */
  public function handleAutocomplete(Request $request, $city) {
    $results = [];

    // Get the typed string from the URL, if it exists.
    if ($input = $request->query->get('q')) {
      $typed_string = Tags::explode($input);
      $typed_string = strtolower(array_pop($typed_string));
      $results = $this->custom_service->getFilterData($typed_string);
    }
    return new JsonResponse($results);
  }
}
