<?php

namespace Drupal\welcome_module;

use Drupal\Core\Session\AccountInterface;

/**
 * Class CustomService
 * @package Drupal\welcome_module\Services
 */
class CustomService {

  protected $currentUser;

  /**
   * CustomService constructor.
   * @param AccountInterface $currentUser
   */
  public function __construct(AccountInterface $currentUser) {
    $this->currentUser = $currentUser;
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData() {
    return $this->currentUser->getDisplayName();
  }

}