<?php
namespace Drupal\welcome_module\Controller;
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

  public function welcome() {  

    $config = $this->configFactory->get('welcome_module.settings_advanced');
// Will print 'Hello'.
print $config->get('site.title');
// Will print 'en'.



exit;

 
     $config =  \Drupal::service('config.factory')->getEditable('welcome_module.performance');
    // Set a scalar value.
    $config->set('cache.page.max_age', 1);
    $config->save();
   // $name = $config->get('cache.page.enabled');
  //  $age=  $config->get('langcode');

    exit;
  /*  $values = [
    [
      'name' => 'Jhon',
      'age' => 30,
      'uid' => 1,
      'did' => 5
    ],
  ];

  $query = $this->db->upsert('welcome_module')->fields(['name', 'age', 'uid']);
  foreach ($values as $developer) {
    $query->values($developer);
  }
  //$query->condition('did', '1');
  $query->key('did');
  $query->execute();
  exit;*/

 /* $query = $this->db->update('welcome_module');
  $query->fields([
    'age' => '36'
  ]);
  $query->condition('uid', '1');
  $query->execute();*/


/*$query = \Drupal::database()->select('welcome_module', 'n');
$query->fields('n', ['name', 'age']);
$query->condition('n.uid', '1');
//$query->range(1, 2);
$data = $query->execute()->fetchAssoc();
print_r($data);*/

/*$query = \Drupal::database()->delete('welcome_module');
$query->condition('uid', '1');
$query->execute();
*/

  //exit;

  // Entity manager query data
  /*$storage = $this->entityTypeManager->getStorage('node');
  $query = $storage->getQuery()
    ->condition('type', 'page')
    ->condition('status', Node::PUBLISHED)
    ->accessCheck(TRUE)
    ->execute();

  $pages = $storage->loadMultiple($query);
  foreach ($pages as $nid) {
     echo $nid->getTitle();
  }*/
 // exit;
   // print_r($query); exit;
/*$entity = $this->entityTypeManager->getStorage('node')->loadMultiple(array(4,3));
  foreach ($entity as $nid) {
     echo $nid->getTitle();
  }
*/


  /* $entity = \Drupal::entityTypeManager()->getStorage('node')->load(1);
    //   $tags= $entity->get('field_tags')->referencedEntities()[0]->getName();
  $tags= $entity->get('field_tags')->referencedEntities()[0]->get('name')->value;
    print_r( $tags);
exit;*/
  /*$nids= \Drupal::entityQuery('node')
          ->condition('type', 'page')
          ->accessCheck(TRUE)
          ->execute();
  //print_r($nids); exit;
  foreach ($nids as $nid) {
     $basic_page=  \Drupal::entityTypeManager()->getStorage('node')->load($nid);
     echo $basic_page->getTitle();
  }*/


//exit;
  /*$info = array('type' => 'page', 'title' => 'My title');
  $node= \Drupal::entityTypeManager()->getStorage('node')->create($info);
  $node->save();*/

  /*$entity = \Drupal::entityTypeManager()->getStorage('node')->load(2);
  $entity->set('body','test update');
    $entity->save();*/
 /* $entity = \Drupal::entityTypeManager()->getStorage('node')->load(2);
  $entity->delete();
  exit;*/

   // $entity = \Drupal::entityTypeManager()->getStorage('node')->load(1);

   // echo  $entity->uid->entity->name->value; exit;
    /*$options = $entity->get('field_option')->getValue(); 

    foreach ($options as $option) {
      $option_list[] = $option['value'];
    }
    print_r( $option_list); exit;*/


    /*echo $entity->getTitle(); echo '<br />';

    echo $entity->get('body')->value; echo '<br />';

    $tags= $entity->get('field_tags')->referencedEntities(); 
    foreach ($tags as $tag) {
      $tags_label[] = $tag->getName();
    }*/
    //$field_user= $entity->get('field_user')->referencedEntities(); 
   // print_r($field_user); exit;
   /* foreach ($field_user as $user) {
      $user_list[] = $user->getDisplayName();
    }*/

   // print_r($user_list); exit;
   /* $link = $entity->field_image->entity->uri->value;
    $title = $entity->field_image->entity->label(); // the title
    $data = $entity->field_image->entity;*/

    //$imgurl = file_create_url($entity->field_image->entity->uri->value);
    //print_r( $user_list); exit;
    //echo $title; exit;
    /*return array(
      '#markup' => 'Welcome to our Website.'
    );*/
  }
}