<?php

namespace Drupal\welcome_module\EventSubscriber;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class ExampleEventSubScriber implements EventSubscriberInterface {

  public static function getSubscribedEvents() {

  


	//$events[ConfigEvents::SAVE][] = array('onsaveconfig');
    $events[KernelEvents::CONTROLLER][] = array('onLoad');

    return $events;
  }

  public function onLoad(FilterControllerEvent $event) {
   \Drupal::messenger()->addStatus('on load.');

  }

  public function onsaveconfig(FilterControllerEvent $event) {
   \Drupal::messenger()->addStatus('config saved.');

  }

}