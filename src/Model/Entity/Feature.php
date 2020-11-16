<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Feature Entity
 *
 * @property int $id
 * @property string $feature_name
 * @property string $feature_details
 * @property string $feature_data_type
 *
 * @property \App\Model\Entity\Product[] $products
 */
class Feature extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'feature_name' => true,
        'feature_details' => true,
        'feature_data_type' => true,
        'products' => true,
        'shapes' => true,
        'colors' => true,
    ];
}
