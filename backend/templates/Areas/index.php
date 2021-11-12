<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Area[]|\Cake\Collection\CollectionInterface $areas
 */
$title = __('Areas');
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
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($areas as $area): ?>
                            <tr>
                                <td><?= h($area->id) ?></td>
                                <td><?= h($area->name) ?></td>
                                <td><?= h($area->deleted) ?></td>
                                <td><?= h($area->created) ?></td>
                                <td><?= h($area->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $area->id], ['class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $area->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                    <?=
                                        $this->Form->postLink(
                                            __('削除'),
                                            [
                                                'action' => 'delete',
                                                $area->id
                                            ],
                                            [
                                                'confirm' => __(
                                                    'この求人募集を削除してもよろしいですか？',
                                                    $area->id
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
