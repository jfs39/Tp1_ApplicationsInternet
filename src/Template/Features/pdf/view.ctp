<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feature $feature
 */
?>

<div class="features view large-9 medium-8 columns content">
    <h3><?= h($feature->id) ?></h3>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Feature Name') ?></th>
            <td><?= h($feature->feature_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Feature Data Type') ?></th>
            <td><?= h($feature->feature_data_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($feature->id) ?></td>
        </tr>
    
    <tr scope="row">
        <th><?= __('Feature Details') ?></th>
        <td><?= $this->Text->autoParagraph(h($feature->feature_details)); ?></td>
</tr>
    </table>
    <div class="related">
        <h4><?= __('Related Products') ?></h4>
        <?php if (!empty($feature->products)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Name') ?></th>
                <th scope="col"><?= __('Product Description') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Other Details') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feature->products as $products): ?>
            <tr>
                <td><?= h($products->id) ?></td>
                <td><?= h($products->product_name) ?></td>
                <td><?= h($products->product_description) ?></td>
                <td><?= h($products->price) ?></td>
                <td><?= h($products->other_details) ?></td>
                <td><?= h($products->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
