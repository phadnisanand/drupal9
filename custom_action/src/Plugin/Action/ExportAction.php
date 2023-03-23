<?php

namespace Drupal\custom_action\Plugin\Action;

use Drupal\Core\Action\ActionBase;
use Drupal\Core\Session\AccountInterface;

/**
 * create custom action
 *
 * @Action(
 *   id = "node_export_action",
 *   label = @Translation("Export Content"),
 *   type = "node"
 * )
 */
class ExportAction extends ActionBase {

    /**
     * {@inheritdoc}
     */
    public function execute($node = NULL) {
        if ($node) {
            // TODO: export your node here
            \Drupal::messenger()->addStatus('node is exported ');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function access($object, AccountInterface $account = NULL, $return_as_object = FALSE) {
        /** @var \Drupal\node\NodeInterface $object */
        // TODO: write here your permissions
        $result = $object->access('create', $account, TRUE);
        return $return_as_object ? $result : $result->isAllowed();
    }

}