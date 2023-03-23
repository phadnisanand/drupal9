<?php

namespace Drupal\custom_action\Plugin\Action;

use Drupal\Core\Action\ConfigurableActionBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * create custom action
 *
 * @Action(
 *   id = "config_node_redirect_action",
 *   label = @Translation("Config redirect User"),
 *   type = "user"
 * )
 */
class ConfigExportAction extends ConfigurableActionBase {

        /**
       * {@inheritdoc}
       */
      public function defaultConfiguration() {
        return ['redirect_url' => '', 'user_role' => '' ];
      }

      /**
       * {@inheritdoc}
       */
      public function buildConfigurationForm(array $form, FormStateInterface $form_state) {

        $form['user_role'] = array(
          '#type'          => 'checkboxes',
          '#title'         => $this->t('Add redirect for developer'),
          '#default_value' => $this->configuration['user_role'],
          '#options'       => user_role_names(),
        );


        $form['redirect_url'] = [
          '#title' => $this->t('Redirect URL'),
          '#type' => 'textfield',
          '#required' => TRUE,
          '#default_value' => $this->configuration['redirect_url'],
        ];

         $form['user_role_content_editor'] = array(
          '#type'          => 'checkboxes',
          '#title'         => $this->t('Add redirect for content_editor'),
          '#default_value' => $this->configuration['user_role_content_editor'],
          '#options'       => user_role_names(),
        );


        $form['redirect_url_content_editor'] = [
          '#title' => $this->t('Redirect URL'),
          '#type' => 'textfield',
          '#required' => TRUE,
          '#default_value' => $this->configuration['redirect_url_content_editor'],
        ];
      
        return $form;
      }

      /**
       * {@inheritdoc}
       */
      public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
        $this->configuration['redirect_url'] = $form_state->getValue('redirect_url');
        $this->configuration['user_role'] = $form_state->getValue('user_role');

        $this->configuration['user_role_content_editor'] = $form_state->getValue('user_role_content_editor');
        $this->configuration['redirect_url_content_editor'] = $form_state->getValue('redirect_url_content_editor');
      }


    /**
     * {@inheritdoc}
     */
    public function execute($user = NULL) {
        if (\Drupal::currentUser()->isAuthenticated()) {
            $user_roles = \Drupal::currentUser()->getRoles();
            foreach($user_roles as $role) {
              if (in_array($role, $this->configuration['user_role'])) {
                $response = new RedirectResponse($this->configuration['redirect_url']);
                $response->send();
              }  

              if (in_array($role, $this->configuration['user_role_content_editor'])) {
                $response = new RedirectResponse($this->configuration['redirect_url_content_editor']);
                $response->send();
              }    
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
      
        $result = $object->access('create', $account, TRUE);
        return $return_as_object ? $result : $result->isAllowed();
    }

}