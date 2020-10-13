<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $user_name
 * @property string $email
 * @property string $user_password
 *
 * @property \App\Model\Entity\Product[] $products
 */
class User extends Entity
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
        'user_name' => true,
        'email' => true,
        'user_password' => true,
        'products' => true,
    ];

    protected function _setPassword($value){
        if(strlen($value)){
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }
}
