<?php

namespace Drupal\libraries_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\libraries_demo\Demo as Demo;
use Coduo\ToString\StringConverter;

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

	public function getlib() {
		// https://packagist.org/packages/coduo/php-to-string
		$datetime = new StringConverter(new \DateTime());
		echo $datetime; // "\DateTime"

		$array = new StringConverter(['foo', 'bar', 'baz']);
		echo $array; // "Array(3)"
		exit;
	}
	
}
