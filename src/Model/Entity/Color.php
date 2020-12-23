<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Color Entity
 *
 * @property int $id
 * @property string $color_name
 * @property string $color_description
 * @property string $color_type
 *
 * @property \App\Model\Entity\Featurespecial[] $featurespecial
 */
class Color extends Entity
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
        'color_name' => true,
        'color_description' => true,
        'color_type' => true,
        'featurespecial' => true,
    ];
}
