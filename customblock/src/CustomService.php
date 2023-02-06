<?php

namespace Drupal\customblock;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Http\ClientFactory;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Path\PathValidator;
use GuzzleHttp\ClientInterface;

/**
 * Class CustomService
 * @package Drupal\customblock\Services
 */
class CustomService {

  protected $currentUser;

  protected $httpClient;
  /**
   * CustomService constructor.
   * @param AccountInterface $currentUser
   */
  public function __construct(ClientInterface $http_client) {
     $this->httpClient = $http_client;
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData($city) { //echo $city; die('coming');
    $endpoint = 'https://api.openweathermap.org/data/2.5/weather?appid=2fe905b0911a99e76db5144924481645&units=metric&q='. $city;

   // echo $endpoint; exit;
    $response = $this->httpClient->get($endpoint,
      ['headers' => ['Accept' => 'application/json']]);
    $data = $response->getBody()->getContents();
    $json_data = json_decode($data);
   // print_r($json_data); exit;
    $items = [];
    $items['temp'] = 'Temp: ' .$json_data->main->temp;
    $items['feels_like']= 'feels_like: ' . $json_data->main->feels_like;
    $items['temp_min']= 'temp_min: '. $json_data->main->temp_min;
    $items['temp_max']= 'temp_max: '.$json_data->main->temp_max;
    $items['location']='location: '.$json_data->name;
    return $items;
  }


  public function getFilterData($typed_string) {
    $endpoint = 'https://api.openweathermap.org/geo/1.0/direct?&limit=5&appid=2fe905b0911a99e76db5144924481645&q=' . $typed_string;
    $response = $this->httpClient->get($endpoint,
      ['headers' => ['Accept' => 'application/json']]);
    $data = $response->getBody()->getContents();
    $json_data = json_decode($data);
    for ($i = 0; $i < count($json_data); $i++) {
        $results[] = [
          'value' => $json_data[$i]->name . ',' . $json_data[$i]->state . ',' . $json_data[$i]->country,
          'label' => $json_data[$i]->name . ',' . $json_data[$i]->state . ',' . $json_data[$i]->country,
        ];
      }
    return $results;
  }
}

