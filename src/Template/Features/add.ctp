<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature $feature
 */

/*$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Features",
    "action" => "getByDataType",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Features/add_edit', ['block' => 'scriptBottom']);
*/

$urlToProductAutocompletedemoJson = $this->Url->build([
    "controller" => "Features",
    "action" => "findFeatureNames",
    "_ext" => "json"
        ]);
        echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToProductAutocompletedemoJson . '";', ['block' => true]);
        echo $this->Html->script('Features/add-edit/featuresAutoComplete', ['block' => 'scriptBottom']);
?>
  <?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

  <?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Features'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li class="nav-item"><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>
<div class="features form large-9 medium-8 columns content">
    <?= $this->Form->create($feature) ?>
    <fieldset>
        <legend><?= __('Add Feature') ?></legend>
        <?php
            //echo $this->Form->control('feature_data_type',['options' => $data_Types]);/*,['options' => $data_Types]*/
            echo $this->Form->control('feature_data_type');/*,['options' => $data_Types]*/
            //echo $this->Form->control('feature_name', ['options' => [__('Please select a data type first')]]);
            echo $this->Form->control('feature_name', ['type' => 'text', 'id'=> 'autocomplete']);
            echo $this->Form->control('feature_details');
            echo $this->Form->control('products._ids', ['options' => $products]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
