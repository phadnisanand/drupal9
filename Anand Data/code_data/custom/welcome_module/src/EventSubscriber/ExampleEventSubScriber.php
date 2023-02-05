<?php

namespace Drupal\welcome_module\EventSubscriber;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Config\ConfigCrudEvent;


class ExampleEventSubScriber implements EventSubscriberInterface {

  public static function getSubscribedEvents() {

  	$events[ConfigEvents::SAVE][] = array('onsaveconfig');
    $events[KernelEvents::CONTROLLER][] = array('onLoad');

    return $events;
  }

  public function onLoad(FilterControllerEvent $event) {
  	
  	//\Drupal::service('cache_tags.invalidator')->invalidateTags('node:1');
   		\Drupal::messenger()->addStatus('on load.');

  }

    public function onsaveconfig(ConfigCrudEvent $event) {
    	$saved_config = $event->getConfig();
    	 //$saved_config->get('first_name');
    	// exit;
    	if($saved_config->getName() == 'welcome_module.settings')
    	{
    		$firstname= $saved_config->get('first_name');
    		$lastname= $saved_config->get('last_name');
    		//echo $firstname; exit;
    		\Drupal::messenger()->addStatus( $firstname . ' ' . $lastname);
    	}
   		
  }

}
