<?php

namespace Drupal\codimth_batch\Commands;

use Drush\Commands\DrushCommands;
use Drupal\node\Entity\Node;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\codimth_batch\DeleteNode;
/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class CodimthDrushCommands extends DrushCommands
{
     /**
   * Entity type service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
    private $entityTypeManager;

    /**
   * Constructs a new UpdateVideosStatsController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity type service.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerChannelFactory
   *   Logger service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }
    /**
     * Drush command that displays the given text.
     *
     * @command codimth_custom_commands:nodedelete
     * @aliases drush-codimth nodedelete
     * @option uppercase
     *   Uppercase the message.
     * @usage codimth_custom_commands:nodedelete
     */
    public function nodedelete() { // die('coming');
        $storage = $this->entityTypeManager->getStorage('node');
         $query = $storage->getQuery()
        ->condition('status', '1');
         $nids = $query->execute();

         $batch = array(
          'title' => t('Deleting Node...'),
          'operations' => array(
            array(
              '\Drupal\codimth_batch\DeleteNode::delete_nodes_example',
              array($nids)
            ),
          ),
          'finished' => '\Drupal\codimth_batch\DeleteNode::delete_nodes_finished',
        );
        batch_set($batch);
        drush_backend_batch_process();
    }
}
