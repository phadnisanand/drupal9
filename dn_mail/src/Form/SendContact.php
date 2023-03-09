<?php

namespace Drupal\dn_mail\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\symfony_mailer\EmailFactoryInterface;
use Drupal\symfony_mailer\MailerHelperInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Render\Markup;
/**
 * Symfony Mailer test email form.
 */
class SendContact extends FormBase {

  

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'symfony_mailer_test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    
    $form['#tree'] = TRUE;

     $form['first_name'] = [
      '#title' => $this->t('First Name'),
      '#type' => 'textfield',
      '#default_value' => '',
    ];

      $form['last_name'] = [
      '#title' => $this->t('Last name'),
      '#type' => 'textfield',
      '#default_value' => '',
    ];


    $form['recipient'] = [
      '#title' => $this->t('Recipient'),
      '#type' => 'textfield',
      '#default_value' => '',
      '#description' => $this->t('Recipient email address. Leave blank to send to yourself.'),
    ];

     
    $form['photo'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Photo'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['jpg png'],
      ],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
     $emailFactory = \Drupal::service('email_factory');
     $to = $form_state->getValue('recipient') ?: $this->currentUser();
     $first_name = $form_state->getValue('first_name');
     $last_name = $form_state->getValue('last_name');


     $form_file = $form_state->getValue('photo', 0);
      if (isset($form_file[0]) && !empty($form_file[0])) {
        $file = File::load($form_file[0]);
       // print_r($file->getFilename()); exit;
        $file->setPermanent();
        $file->save();
      }
      $absolute_path = \Drupal::service('file_system')->realpath('public://'. $file->getFilename());
      

      $result_array = [
        '#theme' => 'email_template',
        '#fname' => $first_name ,
        '#lname' => $last_name ,
      ];
      $html= render($result_array);


      //echo $html; exit;

      /*$rows = [
        [Markup::create('<strong>test 1</strong>'),'test'],
        [Markup::create('<s>test 2</s>'), 'test'],
        [Markup::create('<div>test 3</div>'), 'test'],
      ];
      $header = [
        'title' => t('Title'),
        'content' => t('Content'),
      ];
      $build['table'] = [
        '#type' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#empty' => t('No content has been found.'),
      ];
      $html= render($build);*/



        /*$html = '<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
          <td>&nbsp;</td>
          <td class="container">
            <div class="content">

              <!-- START CENTERED WHITE CONTAINER -->
              <table role="presentation" class="main">

                <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>';

          $html .= " <p>Hi {$to},</p>";
                       
          $html .=  '<p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                        <p>Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class="footer">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    <br> Dont like these emails? <a href="http://i.imgur.com/CScmqnj.gif">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>';*/

      $body['extra'] = ['#markup' =>  $html];
      
      $emailFactory->newTypedEmail('symfony_mailer', 'node')
        ->setTo($to)
        ->attachFromPath($absolute_path)
        ->setSubject('Test email with attachment')
        ->setBody($body)
        ->send();
      $message = is_object($to) ?
        $this->t('An attempt has been made to send an email to you.') :
        $this->t('An attempt has been made to send an email to @to.', ['@to' => $to]);
      $this->messenger()->addMessage($message);

   }

}
