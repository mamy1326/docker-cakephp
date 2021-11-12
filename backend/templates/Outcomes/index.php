<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $outcomes
 */
$title = __('成果マスタ一覧');
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
                                <th scope="col">進捗名</th>
                                <th scope="col">概要</th>
                                <th scope="col">作成日<br>更新日</th>
                                <th scope="col">削除</th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($outcomes as $outcome): ?>
                            <tr>
                                <td><?= h($outcome->id) ?></td>
                                <td><?= h($outcome->name) ?></td>
                                <td><?= h($outcome->description) ?></td>
                                <td><?= h($outcome->created) ?><br><?= h($outcome->modified) ?></td>
                                <td><?= $outcome->delete_icon ?><?= h($outcome->deleted) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $outcome->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                    <?=
                                        $this->Form->postLink(
                                            __('削除'),
                                            [
                                                'action' => 'delete',
                                                $outcome->id
                                            ],
                                            [
                                                'confirm' => __(
                                                    'この成果マスタを削除してもよろしいですか？',
                                                    $outcome->id
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
