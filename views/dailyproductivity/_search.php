<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<div class="dailyproductivity-search">

    <?php $form = ActiveForm::begin([
        'options' => [
                    'class' => 'form-inline',
                    ],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?php
                //echo '<label class="control-label">Período</label>';
                echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'start_date',
                    'attribute2' => 'end_date',
                    'language' => 'pt',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => 'até',
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'seller_id')->checkbox([
                'label' => 'Apenas minhas vendas',
                'labelOptions'=>array('style'=>'padding:5px;'),
                ]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
