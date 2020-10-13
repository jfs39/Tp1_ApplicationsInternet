<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeaturesProducts Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\FeaturesTable&\Cake\ORM\Association\BelongsTo $Features
 *
 * @method \App\Model\Entity\FeaturesProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeaturesProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeaturesProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeaturesProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeaturesProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeaturesProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeaturesProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeaturesProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class FeaturesProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('features_products');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Features', [
            'foreignKey' => 'feature_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['feature_id'], 'Features'));

        return $rules;
    }
}
