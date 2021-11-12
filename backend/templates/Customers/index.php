<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
$title = __('顧客一覧');
$this->assign('title', $title);
?>

<section class="content-header">
    <h1><?= $title ?></h1>
    <div class="pull-right box-tools">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-success margin-bottom']) ?>
    </div>
</section>


<section class="content">
    <div class="row">
    <div class="col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create(null, ['url' => '/Customers', 'type' => 'get']); ?>
                <div class="box-body text-nowrap">
                    <table>
                        <tr>
                            <td style="padding-left: 10px;">
                                <?= $this->Form->control('name', [
                                    'label' => '顧客名',
                                    'type' => 'text',
                                    'div' => false,
                                    'class' => 'form-control',
                                    'value' => $params['name'],
                                    'empty' => true,
                                    'required' => false,
                                ]);
                                ?>
                            </td>
                            <td style="padding-left: 10px;">
                                <?= $this->Form->control('address', [
                                    'label' => '住所',
                                    'type' => 'text',
                                    'div' => false,
                                    'class' => 'form-control',
                                    'value' => $params['address'],
                                    'empty' => true,
                                    'required' => false,
                                ]);
                                ?>
                            </td>
                            <td style="padding-left: 10px;">
                                <?= $this->Form->control('tel', [
                                    'label' => '電話番号',
                                    'type' => 'text',
                                    'div' => false,
                                    'class' => 'form-control',
                                    'value' => $params['tel'],
                                    'empty' => true,
                                    'required' => false,
                                ]);
                                ?>
                            </td>
                            <td style="padding-left: 10px;"><?=
                            $this->Form->control(
                                'deleted',
                                [
                                    'label' => '削除済みを含む',
                                    'type' => 'checkbox',
                                    'hiddenField' => false,
                                    'required' => false,
                                    'checked' => $params['deleted'] == 0 ? false : true,
                                    'empty' => true,
                                ]
                            )
                            ?></td>
                            <td style="padding-left: 10px;">
                                <div class="box-footer">
                                    <?= $this->Form->button(__('検索')) ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body table-responsive no-padding">
                    <h4 style='margin-left:5px;'><?= $this->Paginator->counter('全 {{count}} 件中、{{start}} 〜 {{end}}') ?></h4>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . __('First')) ?>
                            <?= $this->Paginator->prev('< ' . __('Back')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next') . ' >') ?>
                            <?= $this->Paginator->last(__('Last') . ' >>') ?>
                        </ul>
                    </div>
                    <table class="table table-hover text-nowrap dataTable table-striped table-bordered table-condensed" style="font-size:13px;">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">顧客名</th>
                                <th scope="col">流入</th>
                                <th scope="col">郵便番号</th>
                                <th scope="col">エリア</th>
                                <th scope="col">都道府県</th>
                                <th scope="col">住所1<br>住所2<br>住所3</th>
                                <th scope="col">電話番号1<br>電話番号2<br>電話番号3</th>
                                <th scope="col">email</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= h($customer->id) ?></td>
                                <td><?= h($customer->name) ?></td>
                                <td><?= $customer->has('influx') ? $this->Html->link($customer->influx->name, ['controller' => 'Influxes', 'action' => 'edit', $customer->influx->id]) : '' ?></td>
                                <td><?= h($customer->postal_code) ?></td>
                                <td><?= $customer->has('area') ? $this->Html->link($customer->area->name, ['controller' => 'Areas', 'action' => 'edit', $customer->area->id]) : '' ?></td>
                                <td><?= $customer->has('prefecture') ? $this->Html->link($customer->prefecture->name, ['controller' => 'Prefectures', 'action' => 'edit', $customer->prefecture->id]) : '' ?></td>
                                <td><?= h($customer->address_1) ?><br><?= h($customer->address_2) ?><br><?= h($customer->address_3) ?></td>
                                <td><a href="tel:<?= h($customer->tel_1) ?>"><?= h($customer->tel_1) ?></a><br><a href="tel:<?= h($customer->tel_2) ?>"><?= h($customer->tel_2) ?></a><br><a href="tel:<?= h($customer->tel_3) ?>"><?= h($customer->tel_3) ?></a></td>
                                <td><?= h($customer->email) ?></td>
                                <td><?= h($customer->created) ?></td>
                                <td><?= h($customer->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $customer->id], ['class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $customer->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . __('First')) ?>
                            <?= $this->Paginator->prev('< ' . __('Back')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next') . ' >') ?>
                            <?= $this->Paginator->last(__('Last') . ' >>') ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
