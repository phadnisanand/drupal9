<?php
namespace Drupal\crud_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;


class ListArticlesController extends ControllerBase {

	 public function createFormData() { 
	 	$form = \Drupal::formBuilder()->getForm('\Drupal\crud_demo\Form\createForm');
		return $form;

	}

  public function submitData() {

    $postReq = \Drupal::request()->request->all();
    //print_r(  . '  ' . $postReq['age']); exit;
    $name=$postReq['name'];
    $age= $postReq['age'];
  
    \Drupal::database()->insert('simple_custom_table')
        ->fields([
        'name' => $name,
        'age' => $age,
      ])
      ->execute();

      $response= 'form submitted';
    //$response['result'] = \Drupal::service('renderer')->render('Form sumitted');
    return new JsonResponse($response);

  }
  public function updatedlistArticles() {
    echo 'route updated'; exit;

  }

	public function listArticles() {
	$header = array(
     array('data' => $this->t('ID')),
  // We make it sortable by name.
      array('data' => $this->t('Name'), 'field' => 'name', 'sort' => 'asc'),
      array('data' => $this->t('Age')),

    );
 
    $db = \Drupal::database();
    $query = $db->select('simple_custom_table','c');
    $query->fields('c', array('id','name','age'));
    // The actual action of sorting the rows is here.
    $table_sort = $query->extend('Drupal\Core\Database\Query\TableSortExtender')
                        ->orderByHeader($header);
    // Limit the rows to 20 for each page.
    $pager = $table_sort->extend('Drupal\Core\Database\Query\PagerSelectExtender')
                        ->limit(2);
    $result = $pager->execute();
     // Populate the rows.
    $rows = array();
    foreach($result as $row) {
      $rows[] = array('data' => array(
        'id' => $row->id,
        'name' => $row->name,
        'age' => $row->age, // This hardcoded [BLOB] is just for display purpose only.
      ));
    }
 
    // Generate the table.
    $build['config_table'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    );
 
    // Finally add the pager.
    $build['pager'] = array(
      '#type' => 'pager'
    );
 
    return $build;
	}
}