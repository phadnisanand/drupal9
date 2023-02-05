<?php

namespace Drupal\anand_module;

use Drupal\Core\Session\AccountInterface;

/**
 * Class CustomService
 * @package Drupal\anand_module\Services
 */
class AlterService {

  protected $currentUser;

  /**
   * CustomService constructor.
   * @param AccountInterface $currentUser
   */
  public function __construct(AccountInterface $currentUser) {  //die('inn');
    $this->currentUser = $currentUser;
  }


  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData() {


    return 'coming'. $this->currentUser->getDisplayName();
  }

}