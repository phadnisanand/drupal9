<?php

namespace Drupal\custom_module\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Default entity entity.
 *
 * @ConfigEntityType(
 *   id = "default_entity",
 *   label = @Translation("Default entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_module\DefaultEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_module\Form\DefaultEntityForm",
 *       "edit" = "Drupal\custom_module\Form\DefaultEntityForm",
 *       "delete" = "Drupal\custom_module\Form\DefaultEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\custom_module\DefaultEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_export = {
 *     "id",
 *     "label"
 *   },
 *   config_prefix = "default_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/default_entity/{default_entity}",
 *     "add-form" = "/admin/structure/default_entity/add",
 *     "edit-form" = "/admin/structure/default_entity/{default_entity}/edit",
 *     "delete-form" = "/admin/structure/default_entity/{default_entity}/delete",
 *     "collection" = "/admin/structure/default_entity"
 *   }
 * )
 */
class DefaultEntity extends ConfigEntityBase implements DefaultEntityInterface {

  /**
   * The Default entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Default entity label.
   *
   * @var string
   */
  protected $label;

}
