<?php

namespace Drush\Commands;
use drush\drush;

class CustomCommands extends DrushCommands {
  /**
   *
   * See: https://stefvanlooveren.me/blog/fixing-systemsite-uuid-config-import-problem-drupal-8
   * @hook pre-command config:import
   *
   */
  public function setUuid() {

    // Clear cache in order to prevent errors after upgrading drupal
    drupal_flush_all_caches();

	  // Sets a hardcoded site uuid right before `drush config:import`
    $staticUuidIsSet = \Drupal::state()->get('static_uuid_is_set');
    if(!$staticUuidIsSet) {
      $config_factory = \Drupal::configFactory();
      $config_factory->getEditable('system.site')->set('uuid', '66b5bd11-f345-42e4-8a9c-fc2a7b11764b')->save();
      Drush::output()->writeln('Setting the correct UUID for this project: done.');
      \Drupal::state()->set('static_uuid_is_set', 1);
    }

  }
}
