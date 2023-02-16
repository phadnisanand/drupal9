<?php

namespace Drupal\codimth_batch;


use Drupal\node\Entity\Node;

class DeleteNode {

  function delete_nodes_example($nids, &$context){ //die('coming');
      $message = 'Deleting ALL Nodes ...';
      $results = array();
      foreach ($nids as $nid) {
          $node = Node::load($nid);
          $results[] = $node->delete();
      }
      $context['message'] = $message;
      $context['results'] = $nids;
      //print_r( $context); exit;
  }

  function delete_nodes_finished($success, array $results, $operations) {
      //echo  '<pre>';  print_r($success); exit;
      // The 'success' parameter means no fatal PHP errors were detected. All
      // other error management should be handled using 'results'.
      if ($success) {
          $message = \Drupal::translation()->formatPlural(
              count($results),
              'One post processed.', '@count posts processed.'
          );
      }
      else {
          $message = t('Finished with an error.');
      }
      \Drupal::messenger()->addStatus($message);
  }
}
