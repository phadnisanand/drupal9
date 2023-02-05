<?php

/**
 * @file
 * @Contains Drupal\crud\Form\EditForm.
 */

namespace Drupal\crud_demo\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
Use Drupal\Core\Routing;
/**
 * Add form implementation.
 */
class EditForm extends FormBase {
    /**
     * (@inheritdoc)
     */
    public function getFormId() {
        return 'crud_form_id';
    }

    /**
     * (@inheritdoc)
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        //die('coming');
       
        $cid = \Drupal::routeMatch()->getParameter('cid'); 
         //print_r($parameters); exit;
        if (isset($cid)) {
                echo $cid; exit;
        }
    }

    /**
     * (@inheritdoc)
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if (is_numeric($form_state->getValue('first_name'))) {
            $form_state->setErrorByName('first_name', $this->t('Error, The First Name Must Be A String'));
        }
    }

    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $picture = $form_state->getValue('picture');
        $data = [
            'first_name'    => $form_state->getValue('first_name'),
            'last_name'     => $form_state->getValue('last_name'),
            'email'         => $form_state->getValue('email'),
            // 'phone'         => $form_state->getValue('phone'),
            // 'select'        => $form_state->getValue('select'),
            'message'       => $form_state->getValue('message'),
        ];

        if (!is_null($picture[0])) {
            $data += [
                'fid' => $picture[0],
            ];
        }

        if (isset($_GET['id'])) {
            // update data in database
            \Drupal::database()->update('crud_table')->fields($data)->condition('id', $_GET['id'])->execute();
        } else {
            // Insert data to database.
            \Drupal::database()->insert('crud_table')->fields($data)->execute();
        }
        if (!is_null($picture[0])) {
            // Save file as Permanent.
            $file = File::load($picture[0]);
            $file->setPermanent();
            $file->save();
        }

        // Show message and redirect to list page.
        \Drupal::messenger()->addStatus($this->t('Successfully saved'));
        $url = new Url('crud.display_data');
        $response = new RedirectResponse($url->toString());
        $response->send();
    }
}
