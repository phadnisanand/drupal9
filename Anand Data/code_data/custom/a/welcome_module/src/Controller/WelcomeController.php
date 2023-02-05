<?php

namespace Drupal\welcome_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\welcome_module\CustomService;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AddCssCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\welcome_module\Ajax\ExampleCommand;
/**
 * Defines WelcomeController class.
 */
class WelcomeController extends ControllerBase {
   protected $configFactory;

   public static function create(ContainerInterface $container) {
    return new static($container->get('config.factory'));
  }

  public function __construct(ConfigFactory $config_factory) {
    $this->configFactory  =  $config_factory;
  }


  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */


public function content() {

  
$data = \Drupal::cache()->get('custom_tag');

print_r($data);exit; 
   \Drupal\Core\Cache\Cache::invalidateTags(array('custom_tag')); 

   die('coming11');
  /*return array(
        '#markup' => rand(100,2000),
        '#cache' => [
            'tags' => ['node_list'],
        ],
    );*/
    exit;

  /*$markup = '<a class="use-ajax"  href="display-ajax">click me</a>';

  return [
     '#markup' => $markup,
      //'#plain_text' => '<p>This shows how <b>plain_text</b> differs from <b>markup</b> in a render array.</p>.',
     '#attached' => array('library' => 'welcome_module/example-library-invoke')
    ];

    */

    /*
    return [
     '#markup' => '<p>The simplest <b>render array</b> possible.</p>',
      //'#plain_text' => '<p>This shows how <b>plain_text</b> differs from <b>markup</b> in a render array.</p>.',
    ];*/
    


}

  public function ajaxContent() {
    $response = new AjaxResponse();


   /* $config = $this->configFactory->getEditable('welcome_module.settings');
    $first_name= $config->get('first_name');
    $last_name = $config->get('last_name');*/
    //$data = $this->custom_service->getData();
    //$data= \Drupal::service('welcome_module.custom_services');

    //print_r($data->getData()); exit;
    /*$CssString = '<style>h1 {color:red !important;}</style>'; 
    $response->addCommand(new AddCssCommand($CssString));*/


   /* $url='custom command hai'; /* The URL that will be loaded into window.location. This should be a full URL. */
// $response->addCommand(new ExampleCommand($url));

    $response->addCommand(new InvokeCommand(NULL, 'myAjaxCallback', ['This is the new text!']));

    return $response;
    /*return [
     '#markup' => '<p>The simplest <b>render array</b> possible.</p>',
      //'#plain_text' => '<p>This shows how <b>plain_text</b> differs from <b>markup</b> in a render array.</p>.',
    ];*/

    /*return [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'This example shows how a <b>render element</b> works.',
    ];*/

    /*return [
      '#type' => 'container',
      'heading' => [
        '#type' => 'html_tag',
        '#tag' => 'h1',
        '#value' => 'Nested arrays',
      ],
      'content' => [
        [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Array keys starting with # are treated as render element properties.',
        ],
        [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'All the other keys become children.',
        ],
      ],
    ];*/

    
    /*return [
      '#type' => 'markup',
      '#markup' => 'Hi ' . $first_name . ' ' . $last_name . '  ' . 'new ' . $data ,
    ];*/


    /*return array(
            '#theme' => 'mymodule_controller_template',
            '#first_name' => $first_name,
            '#last_name'  => $last_name,
            '#date'  => time()
        );
    */
  }

}