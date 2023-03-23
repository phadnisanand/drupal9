<?php
namespace Drupal\drupaljs_demo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\AjaxResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Defines DemoController class.
 */
class DemoController extends ControllerBase {

	/**
	 * Defines popup content.
	 */
	public function content() {
		$markup = '<div id="click_me">click here</div><div class="myclass"></div>';
		return [
			 '#markup' => $markup,
			 '#attached' => [
					'library' => 'drupaljs_demo/demo',
				]
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
}
