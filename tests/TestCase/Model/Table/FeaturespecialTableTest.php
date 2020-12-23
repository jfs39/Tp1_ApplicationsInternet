<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeaturespecialTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeaturespecialTable Test Case
 */
class FeaturespecialTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FeaturespecialTable
     */
    public $Featurespecial;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Featurespecial',
        'app.Colors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Featurespecial') ? [] : ['className' => FeaturespecialTable::class];
        $this->Featurespecial = TableRegistry::getTableLocator()->get('Featurespecial', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Featurespecial);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
