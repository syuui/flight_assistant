<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


/**
 * Terminal Entity
 *
 * @property int $id
 * @property int $airport_id
 * @property string $name
 * @property string $sname
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Airport $airport
 */
class Terminal extends Entity
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
        'airport_id' => true,
        'name' => true,
        'sname' => true,
        'created' => true,
        'updated' => true,
        'airport' => true
    ];

    protected function _getNameWithLongAirportName()
    {
        return $this->_properties['airport.name'] . $this->_properties['name'];
    }

    protected function _getNameWithShortAirportName()
    {
        return $this->_properties['airport.sname'] . $this->_properties['name'];
    }

    protected function _getShortNameWithLongAirportName()
    {
        return $this->_properties['airport.name'] . $this->_properties['sname'];
    }

    protected function _getShortNameWithShortAirportName()
    {
        return $this->_properties['airport.sname'] . $this->_properties['sname'];
    }
}
