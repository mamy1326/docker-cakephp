<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $driver
 */
?>
<section class="content-header">
    <h1><?= __('ドライバー追加') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($driver) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => 'ドライバー名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'name',
                            ]
                        );
                        echo $this->Form->control(
                            'tel',
                            [
                                'label' => '電話番号（ハイフンなし）',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'tel',
                            ]
                        );
                        echo $this->Form->control(
                            'email',
                            [
                                'label' => 'email',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'email',
                            ]
                        );
                        echo $this->Form->control(
                            'description',
                            [
                                'label' => 'メモ',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'description',
                            ]
                        );
                        echo $this->Form->control(
                            'drivers_stores.store_id',
                            [
                                'label' => '所属店舗',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $stores,
                            ]
                        );
                ?>
                <div class="box-footer">
                    <?= $this->Form->button(__('追加する')) ?>
                    <div class="pull-right box-tools">
                        <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

