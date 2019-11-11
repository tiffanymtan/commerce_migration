<?php

namespace Drupal\commerce_migration\Plugin\migrate\process;

use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Sets product id for variations.
 *
 * @MigrateProcessPlugin(
 *   id = "commerce_product_id"
 * )
 *
 * To do custom value transformations use the following:
 *
 * @code
 * field_location:
 *   plugin: commerce_product_id
 *   source: commerce_product_manual
 * @endcode
 */
class CommerceProductMap extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // Load the array of the product entities by the product type.
    $entities = \Drupal::entityTypeManager()->getStorage("commerce_product")
      ->loadByProperties(["type" => $value]);

    // The line below will check if there is at
    // least one object of $value product in the $entities array because for
    // a $value product to exist, it will need to have one object in
    // the array, hence the use of array_shift().
    // There will only be one object in the $entities array
    // because there will only one product can exist (e.g. there will
    // only be one Broadband product, we can't have two Broadband product
    // because it doesn't exist).
    $entity = array_shift($entities);

    // If there is no object in the $entities array, it means that the $value
    // product has not been made yet (it doesn't exist).
    if (!isset($entity)) {
      throw new MigrateException('Unable to find product entity.');
    }

    // Return id of the entity type.
    return $entity->id();
  }

}
