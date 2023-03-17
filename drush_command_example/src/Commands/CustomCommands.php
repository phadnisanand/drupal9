<?php
namespace Drupal\drush_command_example\Commands;

use Drush\Commands\DrushCommands;


/**
 * Drush command file.
 */
class CustomCommands extends DrushCommands {

  /**
   * A custom Drush command to displays the given text.
   * 
   * @command drush-command-example:print-me
   * @param $text Argument with text to be printed
   * @option uppercase Uppercase the text
   * @aliases ccepm,cce-print-me
   */
  public function printMe($text = 'Hello world!', $options = ['uppercase' => FALSE, 'reverse' => FALSE]) {
    if ($options['uppercase']) {
      $text = strtoupper($text);
    }
	if ($options['reverse']) {
      $text = strrev($text);
    }
    $this->output()->writeln($text);
  }
}