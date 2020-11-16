<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shape Entity
 *
 * @property int $id
 * @property string $shape_name
 * @property int|null $feature_id
 *
 * @property \App\Model\Entity\Feature $feature
 */
class Shape extends Entity
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
        'shape_name' => true,
        'feature_id' => true,
        'feature' => true,
    ];
}
