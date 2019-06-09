<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FlightsFixture
 *
 */
class FlightsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'ID', 'precision' => null, 'autoIncrement' => null],
        'enterprise_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '航空公司', 'precision' => null, 'autoIncrement' => null],
        'number' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '航班号', 'precision' => null, 'fixed' => null],
        'aircraft_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '飞行器注册号', 'precision' => null, 'autoIncrement' => null],
        'ori_terminal_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '始发航站楼', 'precision' => null, 'autoIncrement' => null],
        'ori_datetime' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '起飞时间', 'precision' => null],
        'gate' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '登机口', 'precision' => null, 'fixed' => null],
        'des_terminal_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '到达航站楼', 'precision' => null, 'autoIncrement' => null],
        'des_datetime' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '到达时间', 'precision' => null],
        'seat' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '座位号', 'precision' => null, 'fixed' => null],
        'memo' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '备注', 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '创建时间', 'precision' => null],
        'updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '修改时间', 'precision' => null],
        '_indexes' => [
            'ori_terminal_id' => ['type' => 'index', 'columns' => ['ori_terminal_id'], 'length' => []],
            'des_terminal_id' => ['type' => 'index', 'columns' => ['des_terminal_id'], 'length' => []],
            'fk_aircraft_id' => ['type' => 'index', 'columns' => ['aircraft_id'], 'length' => []],
            'fk_enterprise_id' => ['type' => 'index', 'columns' => ['enterprise_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'des_terminal_id' => ['type' => 'foreign', 'columns' => ['des_terminal_id'], 'references' => ['terminals', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_aircraft_id' => ['type' => 'foreign', 'columns' => ['aircraft_id'], 'references' => ['aircrafts', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_enterprise_id' => ['type' => 'foreign', 'columns' => ['enterprise_id'], 'references' => ['enterprises', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'ori_terminal_id' => ['type' => 'foreign', 'columns' => ['ori_terminal_id'], 'references' => ['terminals', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'enterprise_id' => 1,
                'number' => 'Lorem ',
                'aircraft_id' => 1,
                'ori_terminal_id' => 1,
                'ori_datetime' => '2019-05-02 06:22:20',
                'gate' => 'Lorem ',
                'des_terminal_id' => 1,
                'des_datetime' => '2019-05-02 06:22:20',
                'seat' => 'Lorem ',
                'memo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => 1556778140,
                'updated' => 1556778140
            ],
        ];
        parent::init();
    }
}
