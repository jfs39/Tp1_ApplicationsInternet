<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shape $shape
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shape'), ['action' => 'edit', $shape->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shape'), ['action' => 'delete', $shape->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shape->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shapes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shape'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shapes view large-9 medium-8 columns content">
    <h3><?= h($shape->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Shape Name') ?></th>
            <td><?= h($shape->shape_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feature') ?></th>
            <td><?= $shape->has('feature') ? $this->Html->link($shape->feature->id, ['controller' => 'Features', 'action' => 'view', $shape->feature->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($shape->id) ?></td>
        </tr>
    </table>
</div>
