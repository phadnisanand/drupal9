<?php
/**
 * @file
 * Contains \Drupal\crud_demo\Form\createForm.
 */
namespace Drupal\crud_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\HtmlCommand;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Ajax\ReplaceCommand;
class createForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  	public function getFormId() {
    	return 'create_form';
	}

	 public function buildForm(array $form, FormStateInterface $form_state) {
    $years = range(2019, 2050);
    $years = array_combine($years, $years);
    $year = $form_state->getValue('year');

    $form['year'] = [
      '#type' => 'select',
      '#title' => $this->t('Year'),
      '#options' => $years,
      '#empty_option' => $this->t('- Select year -'),
      '#default_value' => $year,
      '#required' => TRUE,
      '#ajax' => [
	    'event' => 'change',
	    'callback' => '::yearSelectCallback',
	    'wrapper' => 'field-month',
	  ],
    ];

  // echo $month;
    $form['month'] = [
      '#type' => 'select',
      '#title' => $this->t('Month'),
      '#empty_option' => $this->t('- Select month -'),
      '#required' => TRUE,
      '#states' => [
	    '!visible' => [
	      ':input[name="year"]' => ['value' => ''],
	    ],
	  ],
      '#prefix' => '<div id="field-month">',
 	  '#suffix' => '</div>',
 	   '#ajax' => [
	    'event' => 'change',
	    'callback' => '::monthSelectCallback',
	    'wrapper' => 'field-day',
	  ],
    ];

 

    $form['day'] = [
      '#type' => 'select',
      '#title' => $this->t('Day'),
      '#empty_option' => $this->t('- Select day -'),
      '#required' => TRUE,
      '#states' => [
	    '!visible' => [
	      ':input[name="month"]' => ['value' => ''],
	    ],
	  ],
	  '#prefix' => '<div id="field-day">',
	  '#suffix' => '</div>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  public function yearSelectCallback(array &$form, FormStateInterface $form_state) {

  	  if ($selectedValue = $form_state->getValue('year')) {
      // Get the text of the selected option.
      $selectedText = $form['year']['#options'][$selectedValue];
  
		$months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
      //print_r($selectedText); exit;
      // Place the text of the selected option in our textfield.
        $form['month']['#value'] = 4;
        $form['month']['#options'] = $months;
  }
  //return  $form['month'];
  $response = new AjaxResponse();

  $response->addCommand(new ReplaceCommand('#field-month', $form['month']));
 return $response;

   //return $form['month']; 
 	 //return $form['month'];
}
public function monthSelectCallback(array &$form, FormStateInterface $form_state) {
  //return $form['day'];

//$selectedValue = $form_state->getValue('month');

//echo $selectedValue; exit;
	if ($selectedValue = $form_state->getValue('month')) {
      // Get the text of the selected option.
      $selectedText = $form['month']['#options'][$selectedValue];
  
		  $days = range(1, 31);

		  //echo $selectedText ; exit;
   		// $day = $form_state->getValue('day');
      //print_r($selectedText); exit;
      // Place the text of the selected option in our textfield.
        $form['day']['#value'] = 4;
        $form['day']['#options'] = $days;
  }
  //return  $form['month'];
  $response = new AjaxResponse();

  $response->addCommand(new ReplaceCommand('#field-day', $form['day']));
 return $response;


}
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('year');
    $month = $form_state->getValue('month');
    $day = $form_state->getValue('day');
    $messenger = \Drupal::messenger();
    $messenger->addMessage("Year:" . $year  . " Month:" . $month . " Day:" . $day);
  }

}