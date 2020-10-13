<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($product->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $product->has('user') ? $this->Html->link($product->user->id, ['controller' => 'Users', 'action' => 'view', $product->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->product_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Other Details') ?></h4>
        <?= $this->Text->autoParagraph(h($product->other_details)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Features') ?></h4>
        <?php if (!empty($product->features)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Feature Name') ?></th>
                <th scope="col"><?= __('Feature Details') ?></th>
                <th scope="col"><?= __('Feature Data Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->features as $features): ?>
            <tr>
                <td><?= h($features->id) ?></td>
                <td><?= h($features->feature_name) ?></td>
                <td><?= h($features->feature_details) ?></td>
                <td><?= h($features->feature_data_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Features', 'action' => 'view', $features->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Features', 'action' => 'edit', $features->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Features', 'action' => 'delete', $features->id], ['confirm' => __('Are you sure you want to delete # {0}?', $features->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
