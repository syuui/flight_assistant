<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TerminalsFixture
 *
 */
class TerminalsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'ID', 'autoIncrement' => true, 'precision' => null],
        'airport_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '机场', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '名称', 'precision' => null, 'fixed' => null],
        'sname' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '简称', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '创建时间', 'precision' => null],
        'updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '更新时间', 'precision' => null],
        '_indexes' => [
            'airport_id' => ['type' => 'index', 'columns' => ['airport_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'terminals_ibfk_1' => ['type' => 'foreign', 'columns' => ['airport_id'], 'references' => ['airports', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'airport_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'sname' => 'Lorem ',
                'created' => 1556578458,
                'updated' => 1556578458
            ],
        ];
        parent::init();
    }
}
