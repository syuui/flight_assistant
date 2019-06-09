<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flight Entity
 *
 * @property int $id
 * @property int $enterprise_id
 * @property string $number
 * @property int $aircraft_id
 * @property int $ori_terminal_id
 * @property \Cake\I18n\FrozenTime $ori_datetime
 * @property string $gate
 * @property int $des_terminal_id
 * @property \Cake\I18n\FrozenTime $des_datetime
 * @property string $seat
 * @property string $memo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Enterprise $enterprise
 * @property \App\Model\Entity\Aircraft $aircraft
 * @property \App\Model\Entity\Terminal $terminal
 */
class Flight extends Entity
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
        'enterprise_id' => true,
        'number' => true,
        'register_id' => true,
        'ori_terminal_id' => true,
        'ori_datetime' => true,
        'gate' => true,
        'des_terminal_id' => true,
        'des_datetime' => true,
        'seat' => true,
        'memo' => true,
        'created' => true,
        'updated' => true,
        'enterprise' => true,
        'terminal' => true
    ];
}
