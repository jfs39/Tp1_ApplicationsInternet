<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature $feature
 */

$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Features",
    "action" => "getByDataType",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Features/add_edit', ['block' => 'scriptBottom']);
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Features'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="features form large-9 medium-8 columns content">
    <?= $this->Form->create($feature) ?>
    <fieldset>
        <legend><?= __('Add Feature') ?></legend>
        <?php
            //echo $this->Form->control('feature_data_type',['options' => $data_Types]);/*,['options' => $data_Types]*/
            echo $this->Form->control('feature_data_type');/*,['options' => $data_Types]*/
            //echo $this->Form->control('feature_name', ['options' => [__('Please select a data type first')]]);
            echo $this->Form->control('feature_name');
            echo $this->Form->control('feature_details');
            echo $this->Form->control('products._ids', ['options' => $products]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
