<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
  
  <?php $this->extend('../../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['controller'=> 'Products','action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>

<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="table table-striped">
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
   
        <tr>
        <th scope="row"><?= __('Product Description') ?></th>
        <td><?= $this->Text->autoParagraph(h($product->product_description)); ?></td>
        </tr>
    <tr>
        <th scope="row"><?= __('Other Details') ?></th>
        <td><?= $this->Text->autoParagraph(h($product->other_details)); ?></td>
    </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Files') ?></h4>
        <?php if (!empty($product->files)): ?>
            <table cellpadding="0" cellspacing="0">
                <?php foreach ($product->files as $files): ?>
                    <tr>
                        <td>    
                            <?php
                            echo $this->Html->image($files->path . $files->name, [
                                "alt" => $files->name,
                            ]);
                            ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Features') ?></h4>
        <?php if (!empty($product->features)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
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
