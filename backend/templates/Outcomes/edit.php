<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $outcome
 */
?>
<section class="content-header">
    <h1><?= __('成果マスタ編集') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($outcome) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => '成果マスタ名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'name',
                            ]
                        );
                        echo $this->Form->control(
                            'description',
                            [
                                'label' => '概要',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'description',
                            ]
                        );
                        echo $this->Form->control(
                            'deleted',
                            [
                                'label' => '削除',
                                'type' => 'checkbox',
                                'required' => false,
                                'name' => 'deleted',
                                'checked' => $outcome->has('deleted') ? true : false,
                            ]
                        );
                ?>
                <div class="box-footer">
                    <?= $this->Form->button(__('更新する')) ?>
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

