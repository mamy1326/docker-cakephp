<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<section class="content-header">
    <h1><?= __('顧客情報追加') ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="roles form col-md-12">
            <div class="box box-primary">
                <?= $this->Form->create($customer) ?>
                <div class="box-body">
                <?php
                        echo $this->Form->control(
                            'name',
                            [
                                'label' => '顧客名（氏名）',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
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
                            ]
                        );
                        echo $this->Form->control(
                            'postal_code',
                            [
                                'label' => '郵便番号',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'area_id',
                            [
                                'label' => 'エリア',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $areas,
                            ]
                        );
                        echo $this->Form->control(
                            'prefecture_id',
                            [
                                'label' => '都道府県',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                                'options' => $prefectures,
                            ]
                        );
                        echo $this->Form->control(
                            'tel_1',
                            [
                                'label' => 'tel_1',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'address_1',
                            [
                                'label' => '住所_1',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'tel_2',
                            [
                                'label' => 'tel_2',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'address_2',
                            [
                                'label' => '住所_2',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'tel_3',
                            [
                                'label' => 'tel_3',
                                'div' => true,
                                'class' => 'form-control',
                                'required' => false,
                            ]
                        );
                        echo $this->Form->control(
                            'address_3',
                            [
                                'label' => '住所_3',
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

