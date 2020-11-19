<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?php $this->extend('../../Layout/TwitterBootstrap/dashboard'); ?>


<?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>

<div class="products form content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->control('product_name');
            echo $this->Form->control('product_description');
            echo $this->Form->control('price');
            echo $this->Form->control('other_details');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('features._ids', ['options' => $features]);
            echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
