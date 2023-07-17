<?php

namespace Drupal\custom\Controller;
class FirstController {
  public function content() {
   return array(
      '#markup' => 'Hello, World!',
    );
  }
}