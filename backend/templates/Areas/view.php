<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area $area
 */
?>

<section class="content-header">
    <h1><?= h($area->name) ?></h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Areas') ?></h3>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($area->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= h($area->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Deleted') ?></th>
                <td><?= h($area->deleted) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($area->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($area->modified) ?></td>
            </tr>
        </table>
    </div>
</section>
