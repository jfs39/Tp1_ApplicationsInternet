<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Features Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\Feature get($primaryKey, $options = [])
 * @method \App\Model\Entity\Feature newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Feature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Feature|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feature saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Feature[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Feature findOrCreate($search, callable $callback = null, $options = [])
 */
class FeaturesTable extends Table
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

        $this->setTable('features');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Products', [
            'foreignKey' => 'feature_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'features_products',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('feature_name')
            ->maxLength('feature_name', 50)
            ->requirePresence('feature_name', 'create')
            ->notEmptyString('feature_name');

        $validator
            ->scalar('feature_details')
            ->requirePresence('feature_details', 'create')
            ->notEmptyString('feature_details');

        $validator
            ->scalar('feature_data_type')
            ->maxLength('feature_data_type', 50)
            ->requirePresence('feature_data_type', 'create')
            ->notEmptyString('feature_data_type');

        return $validator;
    }
}
