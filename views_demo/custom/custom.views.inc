<?php
use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\query\QueryPluginBase;


function custom_views_data_alter(array &$data) { 
  $table_name = 'example_table';
  $views_name ='product_listing';
  $column_name = 'nid';
  $reference_type = 0;
    if ($table_name != '' && $views_name != '') {
    $data['example_table']['nid'] = [
        'title' => t('dummy content'),
        'help' => t('Relate dummy content to the node content'),
        // Define a relationship to the node_field_data table, so views whose
        // base table is example_table can add a relationship to nodes. To make a
        // relationship in the other direction, you can:
        // - Use hook_views_data_alter() -- see the function body example on that
        //   hook for details.
        // - Use the implicit join method described above.
        'relationship' => [
          // Views name of the table to join to for the relationship.
          'base' => 'node_field_data',
          // Database field name in the other table to join on.
          'base field' => 'nid',
          // ID of relationship handler plugin to use.
          'id' => 'standard',
          // Default label for relationship in the UI.
          'label' => t('dummy node'),
          'handler' => 'views_handler_relationship',
          'label' => t('dummy table relationship'),
          'title' => t('dummy table relationship'),
        ],
      ];
    }
}


function custom_views_pre_execute(ViewExecutable $view) {
  //print_r($view->query->query()->__toString()); die();
}


/**
 * Implements hook_views_query_alter().
 */
function custom_views_query_alter(ViewExecutable $view, QueryPluginBase $query) {

  // Only for my_view view.
  if ($view->id() == 'product_listing') {
    // Example

   // create subquery using database api
   /* $sub_query = \Drupal::database()->select('custom_table', 'n');
    $sub_query->addField('n', 'nid'); 
    $sub_query->groupBy("n.nid");*/

    $sub_query = \Drupal::database()->select('custom_table', 'n');
    $sub_query->addField('n', 'nid');
/*
    $join_definition = [
      'table formula' => $sub_query,
      'field' => 'nid',
      'left_table' => 'node_field_data',
      'left_field' => 'nid',
      'adjust' => TRUE,
    ];*/

    $configuration = [
      'type'       => 'LEFT',
      'table'      => 'custom_table',
      'field'      => 'nid',
      'left_table' => 'custom_table ',
      'left_field' => 'nid',
      'operator'   => '=',
    ];

/*
  $join = Drupal::service('plugin.manager.views.join')->createInstance('standard', $join_definition);
$query->addRelationship('custom_table', $join, 'node_field_data');
*/

 $join_obj = \Drupal\views\Views::pluginManager('join')
      ->createInstance('standard', $configuration);
  $rel = $query->addRelationship('nid', $join_obj, 'node_field_data');
  $query->addTable('custom_table', $rel, $join_obj, 'nid');


  }
}

/*
function custom_views_query_alter(ViewExecutable &$view, QueryPluginBase &$query) {
  if ($view->id() == 'product_listing') {
    foreach ($query->where as &$condition_group) {
      foreach ($condition_group['conditions'] as &$condition) {
        $condition = array(
          'field' => 'node_field_data.nid',
          'value' => 1,
          'operator' => '=',
        );
      }
    }
  }
}
*/