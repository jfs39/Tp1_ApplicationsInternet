<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
$urlToRestApi = $this->Url->build('/api/Products', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Products/index', ['block' => 'scriptBottom']);

?>
<?php $this->extend('../../Layout/TwitterBootstrap/dashboard'); ?>
<?php $this->start('tb_actions'); ?>
<li class="nav-item"><?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', $this->fetch('tb_actions')); ?>

<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('files') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->product_name) ?></td>
                <td><?= $this->Number->format($product->price) ?></td>
                <td><?= $product->has('user') ? $this->Html->link($product->user->username, ['controller' => 'Users', 'action' => 'view', $product->user->id]) : '' ?></td>
                <td><?php
                        if (isset($product->files[0])) {
                            echo $this->Html->image($product->files[0]->path . $product->files[0]->name, [
                                "alt" => $product->files[0]->name,
                                "width" => "220px",
                                "height" => "150px",
                                'url' => ['controller' => 'Files', 'action' => 'view', $product->files[0]->id]
                            ]);
                        }
                        ?>
                    </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id],[ 'class' => 'btn btn-secondary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id],[ 'class' => 'btn btn-secondary']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'btn btn-danger']) ?>
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
