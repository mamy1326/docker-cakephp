<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Job $job
 */
?>

<section class="content-header">
    <h1><?= __('案件情報詳細') ?>
        <div class="pull-right box-tools">
            <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= h($job->name) ?></h3>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('顧客名') ?></th>
                <td><?= $job->has('customer') ? $this->Html->link($job->customer->name, ['controller' => 'Customers', 'action' => 'view', $job->customer->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('店舗') ?></th>
                <td><?= $job->has('store') ? $this->Html->link($job->store->name, ['controller' => 'Stores', 'action' => 'view', $job->store->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('担当ドライバー') ?></th>
                <td><?= $job->has('driver') ? $this->Html->link($job->driver->name, ['controller' => 'Drivers', 'action' => 'view', $job->driver->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('流入') ?></th>
                <td><?= $job->has('influx') ? $this->Html->link($job->influx->name, ['controller' => 'Influxes', 'action' => 'view', $job->influx->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('案件名') ?></th>
                <td><?= h($job->name) ?></td>
            </tr>
            <tr>
                <th><?= __('案件内容') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->description)); ?></td>
            </tr>
            <tr>
                <th><?= __('案件備考') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->description_note)) ?></td>
            </tr>
            <tr>
                <th><?= __('受付') ?></th>
                <td><?= h($job->accept_type) ?></td>
            </tr>
            <tr>
                <th><?= __('訪問日') ?></th>
                <td><?= h($job->date_of_visit) ?></td>
            </tr>
            <tr>
                <th><?= __('見積金額') ?></th>
                <td><?= h($job->estimated_amount) ?></td>
            </tr>
            <tr>
                <th><?= __('見積備考') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->note)) ?></td>
            </tr>
            <tr>
                <th><?= __('コール') ?></th>
                <td><?= h($job->call_status) ?></td>
            </tr>
            <tr>
                <th><?= __('コール備考') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->call_note)) ?></td>
            </tr>
            <tr>
                <th><?= __('①作業希望日') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->hope_date)) ?></td>
            </tr>
            <tr>
                <th><?= __('②担当確認後') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->note_2)) ?></td>
            </tr>
            <tr>
                <th><?= __('③再度担当者 TEL') ?></th>
                <td><?= $this->Text->autoParagraph(h($job->note_3)) ?></td>
            </tr>
            <tr>
                <th><?= __('作成日') ?></th>
                <td><?= h($job->created) ?></td>
            </tr>
            <tr>
                <th><?= __('更新日') ?></th>
                <td><?= h($job->modified) ?></td>
            </tr>
        </table>
    </div>
    <div class="box-footer">
        <div class="pull-right box-tools">
            <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</section>
