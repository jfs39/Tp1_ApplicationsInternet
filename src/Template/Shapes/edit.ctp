<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shape $shape
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $shape->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $shape->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Shapes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shapes form large-9 medium-8 columns content">
    <?= $this->Form->create($shape) ?>
    <fieldset>
        <legend><?= __('Edit Shape') ?></legend>
        <?php
            echo $this->Form->control('shape_name');
            echo $this->Form->control('feature_id', ['options' => $features, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
