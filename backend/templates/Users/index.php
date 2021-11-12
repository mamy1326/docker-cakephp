<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$title = __('管理者一覧');
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
                                <th scope="col">管理者名</th>
                                <th scope="col">email</th>
                                <th scope="col">所属店舗</th>
                                <th scope="col">権限</th>
                                <th scope="col">最終ログイン</th>
                                <th scope="col">作成日</th>
                                <th scope="col">更新日</th>
                                <th scope="col">削除</th>
                                <th scope="col"><?= __('操作') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= h($user->id) ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= $user->has('store') ? h($user->store->name) : '' ?></td>
                                <td><?= count($user->authorities) > 0 ? h($user->authorities[0]->name) : '' ?></td>
                                <td><?= h($user->visited) ?></td>
                                <td><?= h($user->created) ?></td>
                                <td><?= h($user->modified) ?></td>
                                <td><?= $user->delete_icon ?><?= h($user->deleted) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-xs']) ?>
                                    <?=
                                        $this->Form->postLink(
                                            __('削除'),
                                            [
                                                'action' => 'delete',
                                                $user->id
                                            ],
                                            [
                                                'confirm' => __(
                                                    'この管理者を削除してもよろしいですか？',
                                                    $user->id
                                                ),
                                                'class' => 'btn btn-danger btn-xs'
                                            ]
                                        )
                                    ?>
                                    <?= $this->Html->link(__('履歴'), ['action' => 'view-logs', $user->id], ['class' => 'btn btn-info btn-xs']) ?>
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
