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

