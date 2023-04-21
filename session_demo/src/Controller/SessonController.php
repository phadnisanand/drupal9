<?php

/**
 * @file
 * Contains \Drupal\session_demo\Controller\Table
 */
namespace Drupal\session_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

class SessonController extends ControllerBase {
  public function setData() {

    // users private
    /*$tempstore = \Drupal::service('tempstore.private');
    // Get tempstore data we need.
    $tempstore_data = $tempstore->get('my_custom_key');
    $params = $tempstore_data->get('params');
    // Fill vars.
    $params['var_1'] = 'anand';
    $params['var_2'] = 25;
    // Save vars to tempstore.
    $tempstore_data->set('params', $params);*/

    // shared anonoumus user

    $tempstore = \Drupal::service('tempstore.shared');
    // Get tempstore data we need.
    $tempstore_data = $tempstore->get('my_custom_key');
    $params = $tempstore_data->get('params');
    // Fill vars.
    $params['var_1'] = 'baba';
    $params['var_2'] = 65;
    // Save vars to tempstore.
    $tempstore_data->set('params', $params);

    echo 'set coming new'; exit;

  }
  
  public function getData() {
     // users private
    /*$tempstore = \Drupal::service('tempstore.private');
    // Get tempstore data we need.
    $tempstore_data = $tempstore->get('my_custom_key');
    $tempstore_params = $tempstore_data->get('params');
    // Get vars.
    $my_var_1 = $tempstore_params['var_1'];
    $my_var_2 = $tempstore_params['var_2'];
    echo $my_var_1 .   '   '.  $my_var_2; echo '<br />';*/


     // shared anonoumus user
    $tempstore = \Drupal::service('tempstore.shared');
    // Get tempstore data we need.
    $tempstore_data = $tempstore->get('my_custom_key');
    $tempstore_params = $tempstore_data->get('params');
    // Get vars.
    $my_var_1 = $tempstore_params['var_1'];
    $my_var_2 = $tempstore_params['var_2'];
    echo $my_var_1 .   '   '.  $my_var_2; echo '<br />';


    echo 'get coming new'; exit;
    
  }

  public function deleteData() {
     // users private
    $tempstore = \Drupal::service('tempstore.private');
    $tempstore_data = $tempstore->get('my_custom_key');
    $tempstore_params = $tempstore_data->delete('params');

    // shared data delete anonoumus user
    $tempstore = \Drupal::service('tempstore.shared');
    $tempstore_data = $tempstore->get('my_custom_key');
    $tempstore_params = $tempstore_data->delete('params');
    echo 'delete coming'; exit;
    
  }

  public function setSessionData() {
    $session = \Drupal::request()->getSession();
    $profile = 'Person';
    $session->set('profile', $profile);

     echo 'set coming new'; exit;
  }

  public function getSessionData() {
     $session = \Drupal::request()->getSession();
     $details = $session->get('profile');
     echo $details; echo '<br />';
     echo 'get coming new'; exit;

  }

  public function deleteSessionData() {
    $session = \Drupal::request()->getSession();
    $session->remove('profile');
    echo 'delete coming new'; exit;

  }
}
