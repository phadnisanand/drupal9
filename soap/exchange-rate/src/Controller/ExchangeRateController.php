<?php

namespace Drupal\exchange_rate\Controller;

use Drupal\Component\Datetime\DateTimePlus;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Controller\ControllerBase;
use Drupal\exchange_rate\ExchangeRateManager;
/**
 * Class ExchangeRateController
 *
 * @package Drupal\exchange_rate\Controller
 */
class ExchangeRateController extends ControllerBase {

  /**
   * @var \Drupal\exchange_rate\ExchangeRateManager
   */
  protected $manager;

  /**
   * ExchangeRateController constructor.
   *
   * @param \Drupal\exchange_rate\ExchangeRateManager $exchangeRateManager
   */
  public function __construct(ExchangeRateManager $exchangeRateManager) {
    $this->manager = $exchangeRateManager;
  }

  /**
   * Callback function triggered when route `exchange_rate.content` is invoked.
   * @return array
   */
  public function content() {
    $content =  $this->manager->consume();
      return [
      '#markup' => '<p>'.$content.'</p>',
      '#cache' => [
        'tags' => ['config:exchange_rate.settings'],
      ]
    ];
  }
}
