<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeaturesProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeaturesProductsTable Test Case
 */
class FeaturesProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FeaturesProductsTable
     */
    public $FeaturesProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FeaturesProducts',
        'app.Products',
        'app.Features',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeaturesProducts') ? [] : ['className' => FeaturesProductsTable::class];
        $this->FeaturesProducts = TableRegistry::getTableLocator()->get('FeaturesProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeaturesProducts);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
