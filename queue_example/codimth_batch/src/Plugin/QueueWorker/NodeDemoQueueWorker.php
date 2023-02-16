<?php

namespace Drupal\codimth_batch\Plugin\QueueWorker;
use Drupal\node\Entity\Node;
use Drupal\Core\Queue\QueueWorkerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @QueueWorker(
 *   id = "node_demo",
 *   title = @Translation("Node Demo worker"),
 *   cron = {"time" = 60}
 * )
 */
class NodeDemoQueueWorker extends QueueWorkerBase {

  /**
   * {@inheritDoc}
   */
  public function processItem($data) {
    $nodedata = Node::load($data);
    $nodedata->delete();
  }
}
