<?php

namespace Drupal\libraries_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\libraries_demo\Demo as Demo;

/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

	public function disContent() {
		return [
		  '#theme' => 'libraries_demo',
		  '#attached' => array(
	        'library' => array('libraries_demo/test')
	      ),
		];	
	}

	public function staticContent() {

		return [
		  '#theme' => 'libraries_demo',
		  '#attached' => array(
	        'library' => array('libraries_demo/libraries_testing')
	      ),
		];	
	}

	public function getphpContent() {
		$obj = new Demo();
		echo $obj->getName();
		exit;
	}
}
