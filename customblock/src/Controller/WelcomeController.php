<?php
namespace Drupal\customblock\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Connection;
use Drupal\Core\Config\ConfigFactory;



class WelcomeController extends ControllerBase implements ContainerInjectionInterface {
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  protected $entityQuery;

  protected $db;

  protected $configFactory;

  public function __construct(EntityTypeManager
    $entity_type_manager,Connection $connection,ConfigFactory $configFactory) {
    $this->entityTypeManager = $entity_type_manager;
    $this->db= $connection;
    $this->configFactory = $configFactory;

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('database'),
      $container->get('config.factory'),
    );
  }

  public function displayData() {
      print_r($_REQUEST); exit;

  }
}
