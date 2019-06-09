<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Register Entity
 *
 * @property int $id
 * @property string $register
 * @property int $enterprise_id
 * @property int $aircraft_id
 * @property string $memo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Enterprise $enterprise
 * @property \App\Model\Entity\Aircraft $aircraft
 */
class Register extends Entity
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
        'register' => true,
        'enterprise_id' => true,
        'aircraft_id' => true,
        'memo' => true,
        'created' => true,
        'updated' => true,
        'enterprise' => true,
        'aircraft' => true
    ];
}
