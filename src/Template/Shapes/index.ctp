<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shape[]|\Cake\Collection\CollectionInterface $shapes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Shape'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shapes index large-9 medium-8 columns content">
    <h3><?= __('Shapes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shape_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feature_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shapes as $shape): ?>
            <tr>
                <td><?= $this->Number->format($shape->id) ?></td>
                <td><?= h($shape->shape_name) ?></td>
                <td><?= $shape->has('feature') ? $this->Html->link($shape->feature->id, ['controller' => 'Features', 'action' => 'view', $shape->feature->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $shape->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shape->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shape->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shape->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
