<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdminUser[]|\Cake\Collection\CollectionInterface $adminUsers
 */
$title = '管理者ログイン履歴 (' . $loginHistories[0]['Users']['email'] . ')';
$this->assign('title', $title);
?>

<section class="content-header">
    <div class="pull-right box-tools">
        <a href="/users" class="btn btn-default">戻る</a>
    </div>
    <h1><?= $title ?></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ログイン日時</th>
                                <th class="text-center">IPアドレス</th>
                                <th class="text-center">ユーザーエージェント</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($loginHistories as $loginHistory) : ?>
                            <tr>
                                <td class="text-center col-md-1"><?= h($loginHistory->created) ?></td>
                                <td class="text-center"><?= h($loginHistory->ip_addresses_of_decimal) ?></td>
                                <td class="text-center"><?= h($loginHistory->user_agent) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>