<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AircraftsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AircraftsTable Test Case
 */
class AircraftsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AircraftsTable
     */
    public $Aircrafts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aircrafts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Aircrafts') ? [] : ['className' => AircraftsTable::class];
        $this->Aircrafts = TableRegistry::getTableLocator()->get('Aircrafts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Aircrafts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
