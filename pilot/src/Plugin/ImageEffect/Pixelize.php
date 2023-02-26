<?php

/**
 * @file
 * Contains \Drupal\pilot\Plugin\ImageEffect\Pixelize.
 */

namespace Drupal\pilot\Plugin\ImageEffect;

use Drupal\Core\Image\ImageInterface;
use Drupal\image\ConfigurableImageEffectInterface;
use Drupal\image\ImageEffectBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Pixelize an image.
 *
 * @ImageEffect(
 *   id = "pilot_pixelize",
 *   label = @Translation("Pixelize"),
 *   description = @Translation("Test image effect that pixelizes an image.")
 * )
 */
class Pixelize extends ImageEffectBase implements ConfigurableImageEffectInterface {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    return imagefilter($image->getToolkit()->getResource(), IMG_FILTER_PIXELATE, $this->configuration['size'], $this->configuration['advanced']);
  }

  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    return $form;
  
  }

  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    // Intentionally empty.
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'size' => 50,
      'advanced' => 0,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getForm() {

    $form['size'] = array(
      '#type' => 'number',
      '#title' => t('Pixel size'),
      '#default_value' => $this->configuration['size'],
      '#required' => TRUE,
      '#min' => 2,
    );

    $form['advanced'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use advanced pixelization effect'),
      '#default_value' => $this->configuration['advanced'],
    );

    return $form;
  }

}
