<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prefecture $prefecture
 */
?>

<section class="content-header">
    <h1><?= h($prefecture->name) ?></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Prefectures') ?></h3>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('Area') ?></th>
                <td><?= $prefecture->has('area') ? $this->Html->link($prefecture->area->name, ['controller' => 'Areas', 'action' => 'view', $prefecture->area->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($prefecture->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= h($prefecture->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Deleted') ?></th>
                <td><?= h($prefecture->deleted) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($prefecture->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($prefecture->modified) ?></td>
            </tr>
        </table>
    </div>
</section>
