<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Store $store
 */
?>
<section class="content-header">
    <h1><?= __('店舗追加') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($store) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => '店舗名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'name',
                            ]
                        );
                        echo $this->Form->control(
                            'trade_name',
                            [
                                'label' => '屋号',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'name' => 'trade_name',
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

