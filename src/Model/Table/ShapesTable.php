<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shapes Model
 *
 * @property \App\Model\Table\FeaturesTable&\Cake\ORM\Association\BelongsTo $Features
 *
 * @method \App\Model\Entity\Shape get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shape newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shape[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shape|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shape saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shape patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shape[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shape findOrCreate($search, callable $callback = null, $options = [])
 */
class ShapesTable extends Table
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

        $this->setTable('shapes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Features', [
            'foreignKey' => 'feature_id',
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
            ->scalar('shape_name')
            ->maxLength('shape_name', 50)
            ->requirePresence('shape_name', 'create')
            ->notEmptyString('shape_name');

        return $validator;
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
        $rules->add($rules->existsIn(['feature_id'], 'Features'));

        return $rules;
    }
}
