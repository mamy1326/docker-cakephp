<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Job $job
 */
?>
<section class="content-header">
    <h1><?= __('案件情報追加') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($job) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'customer_id',
                            [
                                'label' => '顧客名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $customers,
                                'empty' => true,
                            ]
                        );
                        echo $this->Form->control(
                            'store_id',
                            [
                                'label' => '店舗',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $stores,
                                'empty' => true,
                            ]
                        );
                        echo $this->Form->control(
                            'driver_id',
                            [
                                'label' => '担当ドライバー',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $drivers,
                                'empty' => true,
                            ]
                        );
                        echo $this->Form->control(
                            'influxe_id',
                            [
                                'label' => '流入',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $influxes,
                                'empty' => true,
                            ]
                        );
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => '案件名',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'description',
                            [
                                'label' => '案件内容',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'description_note',
                            [
                                'label' => '案件備考',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'accept_type',
                            [
                                'label' => '受付',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'date_of_visit',
                            [
                                'label' => '訪問日',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'type' => 'datetime',
                            ]
                        );
                        echo $this->Form->control(
                            'estimated_amount',
                            [
                                'label' => '見積金額',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'note',
                            [
                                'label' => '見積備考',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'call_status',
                            [
                                'label' => 'コール',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'call_note',
                            [
                                'label' => 'コール備考',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'hope_date',
                            [
                                'label' => '①作業希望日',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'type' => 'date',
                            ]
                        );
                        echo $this->Form->control(
                            'note_2',
                            [
                                'label' => '②担当確認後',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'note_3',
                            [
                                'label' => '③再度担当者 TEL',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
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

