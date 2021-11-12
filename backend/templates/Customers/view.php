<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>

<section class="content-header">
    <h1><?= __('顧客情報詳細') ?>
        <div class="pull-right box-tools">
            <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('顧客情報') ?></h3>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('id') ?></th>
                <td><?= h($customer->id) ?></td>
            </tr>
            <tr>
                <th><?= __('流入') ?></th>
                <td><?= $customer->has('influx') ? $this->Html->link($customer->influx->name, ['controller' => 'Influxes', 'action' => 'edit', $customer->influx->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('顧客名（氏名）') ?></th>
                <td><?= h($customer->name) ?></td>
            </tr>
            <tr>
                <th><?= __('郵便番号') ?></th>
                <td><?= h($customer->postal_code) ?></td>
            </tr>
            <tr>
                <th><?= __('エリア') ?></th>
                <td><?= $customer->has('area') ? $this->Html->link($customer->area->name, ['controller' => 'Areas', 'action' => 'view', $customer->area->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('都道府県') ?></th>
                <td><?= $customer->has('prefecture') ? $customer->prefecture->name : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Tel_1') ?><br><?= __('Tel_2') ?><br><?= __('Tel_3') ?></th>
                <td>
                    <a href="tel:<?= h($customer->tel_1) ?>"><?= h($customer->tel_1) ?></a><br>
                    <a href="tel:<?= h($customer->tel_2) ?>"><?= h($customer->tel_2) ?></a><br>
                    <a href="tel:<?= h($customer->tel_3) ?>"><?= h($customer->tel_3) ?></a>
                </td>
            </tr>
            <tr>
                <th><?= __('住所_1') ?><br><?= __('住所_2') ?><br><?= __('住所_3') ?></th>
                <td>
                    <?= h($customer->address_1) ?><br>
                    <?= h($customer->address_2) ?><br>
                    <?= h($customer->address_3) ?>
                </td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($customer->email) ?></td>
            </tr>
            <tr>
                <th><?= __('作成日') ?></th>
                <td><?= h($customer->created) ?></td>
            </tr>
            <tr>
                <th><?= __('更新日') ?></th>
                <td><?= h($customer->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('削除') ?></th>
                <td><?= $customer->delete_icon ?><?= h($customer->deleted) ?></td>
            </tr>
        </table>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('案件履歴（最新 50 件）') ?></h3>
        </div>
        <table class="table table-bordered">
            <tr>
                <th><?= __('id') ?></th>
                <td><?= h($customer->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="box-footer">
        <div class="pull-right box-tools">
            <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</section>
