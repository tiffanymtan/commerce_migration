<?php

namespace Drupal\commerce_migration\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Sets product id for variations.
 *
 * @MigrateProcessPlugin(
 *   id = "commerce_price"
 * )
 *
 * To do custom value transformations use the following:
 *
 * @code
 * field_location:
 *   plugin: commerce_price
 *   source: commerce_price_manual
 * @endcode
 */
class CommercePrice extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // Set the price and the currency code.
    $price = [
      'number' => $value,
      'currency_code' => 'AUD',
    ];
    return $price;

  }

}
