<?php
namespace Drupal\route_demo\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class PopupForm extends FormBase {
  /** * {@inheritdoc} */
  public function getFormId() {
    return 'popup_form';
  }
  /** * {@inheritdoc} */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user_mail'] = [
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
     '#type' => 'submit',
     '#value' => $this->t('Subscribe'),
    ];
    return $form;
  }
  /** * {@inheritdoc} */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Nothing.
  }
  /** * {@inheritdoc} */
  public function submitForm(array &$form, FormStateInterface $form_state) {
   \Drupal::messenger()->addStatus('Form saved.'. $form_state->getValue('user_mail'));
  }
}
