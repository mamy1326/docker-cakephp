<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $drivers
 */
$title = __('ドライバー一覧');
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
                                <th scope="col">ドライバー名</th>
                                <th scope="col">電話番号</th>
                                <th scope="col">email</th>
                                <th scope="col">所属店舗</th>
                                <th scope="col">メモ</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                                <th scope="col">削除</th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($drivers as $driver): ?>
                            <tr>
                                <td><?= h($driver->id) ?></td>
                                <td><?= h($driver->name) ?></td>
                                <td><a href="tel:<?= h($driver->tel) ?>"><?= h($driver->tel) ?></a></td>
                                <td><?= h($driver->email) ?></td>
                                <td><?= count($driver->stores) > 0 ? h($driver->stores[0]->name) : '' ?></td>
                                <td><?= h($driver->description) ?></td>
                                <td><?= h($driver->created) ?></td>
                                <td><?= h($driver->modified) ?></td>
                                <td><?= $driver->delete_icon ?><?= h($driver->deleted) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $driver->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                    <?=
                                        $this->Form->postLink(
                                            __('削除'),
                                            [
                                                'action' => 'delete',
                                                $driver->id
                                            ],
                                            [
                                                'confirm' => __(
                                                    'このドライバーを削除してもよろしいですか？',
                                                    $driver->id
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
