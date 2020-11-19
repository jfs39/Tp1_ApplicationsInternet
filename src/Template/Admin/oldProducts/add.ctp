<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */

use function PHPSTORM_META\type;

$urlToProductAutocompletedemoJson = $this->Url->build([
    "controller" => "Products",
    "action" => "findProductNames",
    "_ext" => "json"
        ]);
        echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToProductAutocompletedemoJson . '";', ['block' => true]);
        echo $this->Html->script('Products/add-edit/productsAutoComplete', ['block' => 'scriptBottom']);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('product_name', ['type' => 'text', 'id'=> 'autocomplete']);
            echo $this->Form->control('product_description');
            echo $this->Form->control('price');
            echo $this->Form->control('other_details');
            echo $this->Form->control('features._ids', ['options' => $features]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
