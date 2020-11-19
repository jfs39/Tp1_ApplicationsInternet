<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature $feature
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
<div class="features form large-9 medium-8 columns content">
    <?= $this->Form->create($feature) ?>
    <fieldset>
        <legend><?= __('Edit Feature') ?></legend>
        <?php
            echo $this->Form->control('feature_data_type');
            echo $this->Form->control('feature_name');
            echo $this->Form->control('feature_details');
            echo $this->Form->control('products._ids', ['options' => $products]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
