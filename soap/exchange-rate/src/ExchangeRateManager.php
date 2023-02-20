<?php

namespace Drupal\exchange_rate;

use Drupal\Component\Datetime\DateTimePlus;
use Drupal\Component\Utility\Environment;
use Drupal\Component\Utility\Tags;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Config\Config;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Site\Settings;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\Serializer;
use \SoapClient;
/**
 * Class ExchangeRateManager
 *
 * @package Drupal\exchange_rate
 */
class ExchangeRateManager {

  /**
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * @var \Symfony\Component\Serializer\Serializer
   */
  protected $serializer;

  /**
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cache;

  /** @var \Drupal\Core\Config\ImmutableConfig */
  protected $config;

  /** @var string */
  protected $siteName;

  /**
   * ExchangeRateManager constructor.
   *
   * @param \GuzzleHttp\Client $http_client
   * @param \Symfony\Component\Serializer\Serializer $serializer
   * @param \Drupal\Core\Cache\CacheBackendInterface $cacheBackend
   */
  public function __construct(Client $http_client, Serializer $serializer, CacheBackendInterface $cacheBackend, ConfigFactory $configFactory) {
    $this->httpClient = $http_client;
    $this->serializer = $serializer;
    $this->cache = $cacheBackend;
    $this->config = $configFactory->get('exchange_rate.settings');
    $this->siteName = $configFactory->get('system.site')->get('name');
  }

  /**
   * Consume API service by using given arguments.
   *
   * @param array $dates
   * @param int $type
   *
   * @return null|array
   */
  public function consume() {
 
    $params = [
      'Celsius' => $this->config->get('token'),
    ];
    // Init resource variable.
    $resource = NULL;

    try {
      /** @var string $url */
      $wsdl = $this->config->get('endpoint');
      $client = new SoapClient($wsdl, array('trace'=>1)); 
      $responce_param = $client->CelsiusToFahrenheit($params);
      $resource= $responce_param->CelsiusToFahrenheitResult;
      }
      catch (\RuntimeException $e) {
      // Show error message and log error message.
        watchdog_exception(__METHOD__, $e);
      }

    return $resource;
  }
}
