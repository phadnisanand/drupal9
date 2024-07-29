<?php

namespace Drupal\custom_logger\Controller;
use Drupal\Core\Controller\ControllerBase;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Provides route responses for the Example module.
 */
class CustomLoggerController extends ControllerBase {
		public function printLog() {
			
			$log_path = 'C:\xampp\htdocs\www\drupal\modules\custom_logger\log' . DIRECTORY_SEPARATOR;
			$log_file_name = 'demo.txt';
			$log = new Logger('CustomLog');
      $log->pushHandler(new StreamHandler($log_path . $log_file_name));
      $separator = "|";
      $log->info("Custom logger: " );
      $log->info($separator . "NAME: " , array('Anand Phadnis'));
      $log->info($separator . "AGE : ",  array(38));
      $log->info($separator . "Salary: ", array(100000));
      die('coming here');
		}
		
		public function customApi() {
			$client = \Drupal::httpClient();
			$request = $client->get('https://jsonplaceholder.typicode.com/posts');
			$response = json_decode($request->getBody());
			$str = '<ul>';
			foreach($response as $resp) {
					$str .= '<li>' . $resp->title. '</li>';
			}
			return array(
				'#type' => 'markup',
				'#markup' => $str,
			);
		}
		
		public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('<div id="paymentprocHolder">
TEST CONTROLER
</div>'),
    );
  }
}