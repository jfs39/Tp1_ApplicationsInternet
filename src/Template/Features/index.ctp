<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature[]|\Cake\Collection\CollectionInterface $features
 */
?>
  <?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

  <?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Features'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li class="nav-item"><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>
<div class="features index large-9 medium-8 columns content">
    <h3><?= __('Features') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feature_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('feature_data_type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($features as $feature): ?>
            <tr>
                <td><?= $this->Number->format($feature->id) ?></td>
                <td><?= h($feature->feature_name) ?></td>
                <td><?= h($feature->feature_data_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View (pdf)'), ['action' => 'view', $feature->id . '.pdf']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feature->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feature->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feature->id)]) ?>
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
