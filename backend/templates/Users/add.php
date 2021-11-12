<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<section class="content-header">
    <h1><?= __('管理者追加') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($user) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'username',
                            [
                                'label' => '管理者名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'email',
                            [
                                'label' => 'email',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'store_id',
                            [
                                'label' => '所属店舗',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $stores,
                            ]
                        );
                        echo $this->Form->control(
                            'users_authorities.authority_id',
                            [
                                'label' => '権限',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $authorities,
                            ]
                        );
                ?>
                <div class="box-footer">
                    <?= $this->Form->button(__('追加する')) ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                    </div>
                    <br>※パスワード設定は「パスワードリセット」（パスワードを忘れた場合はコチラ）を使用し、利用者本人が設定してください。<br>セキュリティ向上のために必要な機能です。
                </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

