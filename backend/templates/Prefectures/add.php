<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prefecture $prefecture
 */
?>
<section class="content-header">
    <h1><?= __('Prefectures') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($prefecture) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'area_id',
                            [
                                'label' => 'area_id',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'area_id',
                                'options' => $areas,
                            ]
                        );
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => 'name',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'name',
                            ]
                        );
                        echo $this->Form->control(
                            'deleted',
                            [
                                'label' => 'deleted',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'deleted',
                                'empty' => true,
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

