<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Colors Model
 *
 * @property \App\Model\Table\FeaturespecialTable&\Cake\ORM\Association\HasMany $Featurespecial
 *
 * @method \App\Model\Entity\Color get($primaryKey, $options = [])
 * @method \App\Model\Entity\Color newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Color[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Color|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Color saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Color patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Color[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Color findOrCreate($search, callable $callback = null, $options = [])
 */
class ColorsTable extends Table
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

        $this->setTable('colors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Featurespecial', [
            'foreignKey' => 'color_id',
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
            ->scalar('color_name')
            ->maxLength('color_name', 30)
            ->requirePresence('color_name', 'create')
            ->notEmptyString('color_name');

        $validator
            ->scalar('color_description')
            ->maxLength('color_description', 50)
            ->requirePresence('color_description', 'create')
            ->notEmptyString('color_description');

        $validator
            ->scalar('color_type')
            ->maxLength('color_type', 30)
            ->requirePresence('color_type', 'create')
            ->notEmptyString('color_type');

        return $validator;
    }
}
