<?php

namespace Drupal\custom_plugin\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Default entity type entity.
 *
 * @ConfigEntityType(
 *   id = "default_entity_type",
 *   label = @Translation("Default entity type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_plugin\DefaultEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_plugin\Form\DefaultEntityTypeForm",
 *       "edit" = "Drupal\custom_plugin\Form\DefaultEntityTypeForm",
 *       "delete" = "Drupal\custom_plugin\Form\DefaultEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\custom_plugin\DefaultEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_export = {
 *     "id",
 *     "label"
 *   },
 *   config_prefix = "default_entity_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "default_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/default_entity_type/{default_entity_type}",
 *     "add-form" = "/admin/structure/default_entity_type/add",
 *     "edit-form" = "/admin/structure/default_entity_type/{default_entity_type}/edit",
 *     "delete-form" = "/admin/structure/default_entity_type/{default_entity_type}/delete",
 *     "collection" = "/admin/structure/default_entity_type"
 *   }
 * )
 */
class DefaultEntityType extends ConfigEntityBundleBase implements DefaultEntityTypeInterface {

  /**
   * The Default entity type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Default entity type label.
   *
   * @var string
   */
  protected $label;

}
