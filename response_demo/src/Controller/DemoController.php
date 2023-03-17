<?php

namespace Drupal\response_demo\Controller;
use Spatie\SimpleExcel\SimpleExcelReader;
use Drupal\Core\Controller\ControllerBase;
/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

/**
 * Defines popup content.
 */
public function content() {
	//   composer "misd/linkify": "^1.1",
      //  "spatie/simple-excel": "^1.13"

  /*$markup = 'Example route';
  $pathToCsv = \Drupal::service('file_system')->realpath('public://customers.csv');
//echo '<pre>'; print_r($pathToCsv ); exit;
	  // $rows is an instance of Illuminate\Support\LazyCollection
	$rows = SimpleExcelReader::create($pathToCsv)->getRows();
	$customers= array();
    $rows->each(function(array $rowProperties) {
		print_r($rowProperties['Email']); 
	});*/
	
	/*$linkify = new \Misd\Linkify\Linkify();
$text = 'This is my text containing a link to www.example.com.';
echo $text; echo '<br />';
echo $linkify->process($text);
	
exit;*/
$markup = 'Example route';
  return [
     '#markup' => $markup,
    ];
  }
}
