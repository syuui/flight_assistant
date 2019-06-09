<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistersFixture
 *
 */
class RegistersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'ID', 'precision' => null, 'autoIncrement' => null],
        'register' => ['type' => 'string', 'length' => 16, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '注册号', 'precision' => null, 'fixed' => null],
        'enterprise_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '航空公司', 'precision' => null, 'autoIncrement' => null],
        'aircraft_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '机型', 'precision' => null, 'autoIncrement' => null],
        'memo' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '备注', 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '创建时间', 'precision' => null],
        'updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '更新时间', 'precision' => null],
        '_indexes' => [
            'enterprise_id' => ['type' => 'index', 'columns' => ['enterprise_id'], 'length' => []],
            'aircraft_id' => ['type' => 'index', 'columns' => ['aircraft_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'aircraft_id' => ['type' => 'foreign', 'columns' => ['aircraft_id'], 'references' => ['aircrafts', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'enterprise_id' => ['type' => 'foreign', 'columns' => ['enterprise_id'], 'references' => ['enterprises', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'register' => 'Lorem ipsum do',
                'enterprise_id' => 1,
                'aircraft_id' => 1,
                'memo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => 1556781742,
                'updated' => 1556781742
            ],
        ];
        parent::init();
    }
}
