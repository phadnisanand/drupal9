<?php

namespace Drupal\crud_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Link;

class CrudDemoController extends ControllerBase {
	
	 public function display() {

	 	$header_table = array(
	        'Id'=>   t('ID'),
	        'name' => t('Name'),
	        'age' => t('Age'),
	        'opt' => t('Delete'),
	        'opt1' => t('Edit'),
	    );

	 	$query = \Drupal::database()->select('custom_table', 'm');
      	$query->fields('m', ['id','name','age']);
     	$results = $query->execute()->fetchAll();
     	$rows=array();
		foreach($results as $data){
	      
	        $delete= Url::fromRoute('crud_demo.delete_form', array('cid' => $data->id)); 
	        $edit= Url::fromRoute('crud_demo.edit_form', array('cid' => $data->id)); 

	     
            $rows[] = array(
            	'id' =>$data->id,
                'name' => $data->name,
                'age' => $data->age,
                 Link::fromTextAndUrl(t('Delete'), $delete),
                 Link::fromTextAndUrl('Edit', $edit),
            );
		}
  
    	$form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No users found'),
        ];
        return $form;
	 }
} 