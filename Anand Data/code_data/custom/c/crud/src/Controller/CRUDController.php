<?php

/**
 * @file
 * @Contains Drupal\crud\Controller\CRUDController.
 */

namespace Drupal\crud\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

/**
 * Implement CRUD class operations.
 */
class CRUDController extends ControllerBase {
    public function index() {
       

       /* $query = \Drupal::database()->select('crud_table', 'm');
       // $query->fields('m', ['id', 'first_name', 'last_name', 'email', 'message']);
        $query->addField('m', 'first_name');
        //$query->range(0, 1);
        $query->condition('id', '1');
        $results = $query->execute()->fetchField();
        print_r($results);*/

       /* $query = \Drupal::database()->insert('crud_table');
        $query->fields([
          'first_name',
          'last_name',
          'email',
          'message'
        ]);
        $query->values([
          'nutan',
          'phadnis',
          'nutan@gmail.com',
          'hi nutan'
        ]);
        $query->execute();*/

       /* $query = \Drupal::database()->update('crud_table');
        $query->fields([
          'first_name' => 'sudhir'
        ]);
        $query->condition('id', 1);
        $query->execute();*/


        /*$query = \Drupal::database()->upsert('crud_table');
        $query->fields([
          'id',
          'first_name',
          'last_name',
          'email',
          'message'
        ]);
        $query->values([
           '1',
          'new',
          'phadnis',
          'nutan@gmail.com',
          'hi nutan'
        ]);
        $query->key('id');
        $query->execute();*/

        /* $query = \Drupal::database()->delete('crud_table');
        $query->condition('id', '1');
        $query->execute(); 
        */

       /* $query = \Drupal::database()->select('node_field_data', 'nfd');

        $query->addField('nfd', 'title');

        $query->addField('ufd', 'name');

        $query->join('users_field_data', 'ufd', 'ufd.uid = nfd.uid');

        $query->condition('nfd.type', 'article');

        $result = $query->еxecute()->fetchAll();

        print_r($result); */


       
       /*$node_storage = \Drupal::entityTypeManager()->getStorage('node');
       $node = $node_storage->load(1);
       print_r($node->title->value);*/

        /*$config = \Drupal::config('system.site');

        echo $config->get('name');*/

        /* \Drupal::configFactory()->getEditable('system.site')
        ->set('name', 'Demo')
        ->save(); */
        exit;
    }

    public function show(int $id) {
        $conn = Database::getConnection();

        $query = $conn->select('crud_table', 'm')
            ->condition('id', $id)
            ->fields('m');
        $data = $query->execute()->fetchAssoc();
        $full_name = $data['first_name'] . ' ' . $data['last_name'];
        $email = $data['email'];
        // $phone = $data['phone'];
        $message = $data['message'];

        $file = File::load($data['fid']);
        $picture = $file->createFileUrl();

        return [
            '#type' => 'markup',
            '#markup' => "<h1>$full_name</h1><br>
                          <img src='$picture' width='100' height='100' /> <br>
                          <p>$email</p>
                          <p>$message</p>"
        ];
    }
}
