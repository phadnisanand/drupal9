<?php
namespace Drupal\drupaljs_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\AjaxResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

	/**
	 * Defines popup content.
	 */
	public function content() {
		
		/* dropbutton
		
			$db = [
				'#type' => 'dropbutton', 
				'#links' => [
					'a' => [
						'title' => $this->t('Google'), 
						'url' =>  Url::fromUri('http://www.google.com'),
					],
					'b' => [
						 'title' => $this->t('Yahoo'), 
						 'url' =>  Url::fromUri('http://www.yahoo.com'),
					],
				],
			];
		
			return [
			 '#markup' => render($db),
			
			];*/


		$markup = '<div id="click_me">click here</div><div class="myclass"></div><div class="myclass11"></div>';
		return [
			 '#markup' => $markup,
			 '#attached' => [
					'library' => 'drupaljs_demo/demo',
				]
			];
  }
	
	public function tabledisplay() {
		$group_class = 'group-order-weight';
		$header = [
      'col1' => t('COL1'),
      'col2' => t('COL2'),
    ];
 		
		$row1 = array('test col 1', 'test');
		$rows[] = array('data' => $row1, 'class' => array('draggable'));
		$row2 = array('test col 2', 'test');
		$rows[] = array('data' => $row2, 'class' => array('draggable'));
		$row3 = array('test col 3', 'test');
		$rows[] = array('data' => $row3, 'class' => array('draggable'));

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
			'#tableselect' => FALSE,
			'#tabledrag' => [
				[
					'action' => 'order',
					'relationship' => 'sibling',
					'group' => $group_class,
				]
			],
			'#attributes' => [
				'id' => 'admin-dblog',
				'class' => [
					'admin-dblog',
				],
			],
    ];
  }

	public function ajaxcontent(): JsonResponse {
    $currentTime = \Drupal::service('date.formatter')->format(time());
    $time = [
      '#markup' => $this->t('Current time: @time', ['@time' => $currentTime]),
    ];
		$response = new AjaxResponse();
		$response->addCommand(new AppendCommand('.myclass', render($time)));
		return $response;
  }
	
	 /**
   * @return JsonResponse
   */
  public function handleAutocomplete(Request $request)
  {
    $results = [];
    $input = $request->query->get('q');
    if (!$input) {
      return new JsonResponse($results);
    }
    $input = Xss::filter($input);
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'article')
      ->condition('title', $input, 'CONTAINS')
      ->groupBy('nid')
      ->sort('created', 'DESC')
      ->range(0, 10);
    $ids = $query->execute();
    $nodes = $ids ? \Drupal\node\Entity\Node::loadMultiple($ids) : [];
    foreach ($nodes as $node) {
      $results[] = [
        'value' => EntityAutocomplete::getEntityLabels([$node]),
        'label' => $node->getTitle().' ('.$node->id().')',
      ];
    }
    return new JsonResponse($results);
  }
}
