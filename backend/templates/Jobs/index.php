<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Job[]|\Cake\Collection\CollectionInterface $jobs
 */
$title = __('案件一覧');
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
                                <th scope="col">店舗</th>
                                <th scope="col">担当ドライバー</th>
                                <th scope="col">流入</th>
                                <th scope="col">案件名</th>
                                <th scope="col">依頼内容</th>
                                <th scope="col">受付</th>
                                <th scope="col"><?= $this->Paginator->sort('date_of_visit', '訪問日時') ?></th>
                                <th scope="col">見積金額</th>
                                <th scope="col">コール</th>
                                <th scope="col">①作業希望日</th>
                                <th scope="col">②担当確認後</th>
                                <th scope="col">③再度担当者 TEL</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jobs as $job): ?>
                            <tr>
                                <td><?= h($job->id) ?></td>
                                <td><?= $job->has('customer') ? $this->Html->link($job->customer->name, ['controller' => 'Customers', 'action' => 'view', $job->customer->id]) : '' ?></td>
                                <td><?= $job->has('store') ? $this->Html->link($job->store->name, ['controller' => 'Stores', 'action' => 'view', $job->store->id]) : '' ?></td>
                                <td><?= $job->has('driver') ? $this->Html->link($job->driver->name, ['controller' => 'Drivers', 'action' => 'view', $job->driver->id]) : '' ?></td>
                                <td><?= $job->has('influx') ? $this->Html->link($job->influx->name, ['controller' => 'Influxes', 'action' => 'view', $job->influx->id]) : '' ?></td>
                                <td><?= h($job->name) ?></td>
                                <td style='width: 300px;'><?= h($job->description) ?></td>
                                <td><?= h($job->accept_type) ?></td>
                                <td><?= h($job->date_of_visit) ?></td>
                                <td><?= h($this->Number->currency($job->estimated_amount)) ?></td>
                                <td><?= h($job->call_status) ?></td>
                                <td><?= h($job->hope_date) ?></td>
                                <td><?= h($job->note_2) ?></td>
                                <td><?= h($job->note_3) ?></td>
                                <td><?= h($job->created) ?></td>
                                <td><?= h($job->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $job->id], ['class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $job->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                    <?=
                                        $this->Form->postLink(
                                            __('削除'),
                                            [
                                                'action' => 'delete',
                                                $job->id
                                            ],
                                            [
                                                'confirm' => __(
                                                    'この案件を削除してもよろしいですか？',
                                                    $job->id
                                                ),
                                                'class' => 'btn btn-danger btn-xs'
                                            ]
                                        )
                                    ?>
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
