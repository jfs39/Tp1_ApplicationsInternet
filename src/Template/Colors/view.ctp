<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Color'), ['action' => 'edit', $color->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Color'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Color'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Features'), ['controller' => 'Features', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feature'), ['controller' => 'Features', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="colors view large-9 medium-8 columns content">
    <h3><?= h($color->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Color Name') ?></th>
            <td><?= h($color->color_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feature') ?></th>
            <td><?= $color->has('feature') ? $this->Html->link($color->feature->id, ['controller' => 'Features', 'action' => 'view', $color->feature->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($color->id) ?></td>
        </tr>
    </table>
</div>