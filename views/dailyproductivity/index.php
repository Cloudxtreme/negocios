<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Product;
use app\models\Modality;
use app\models\User;

$this->title = 'Produtividade Diária';

?>
<div class="dailyproductivity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_menu'); ?>
    <hr/>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-hover'],        
        'columns' => [
            [
             'attribute' => 'id',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 5%;text-align:left'],
            ],
            [
             'attribute' => 'date',
             'enableSorting' => true,
             'contentOptions'=>['style'=>'width: 4%;text-align:center'],
             'format' => ['date', 'php:d/m/Y'],
            ],            
            [
             'attribute' => 'location_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->location->shortname;
                    },
             'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
             'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],            
            [
             'attribute' => 'product_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->product->name;
                    },
             'filter' => ArrayHelper::map(Product::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
             'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],              
            [
             'attribute' => 'modality_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->modality->name;
                    },
             'filter' => ArrayHelper::map(Modality::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
             'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],              
            //'manager',
            'value',
            // 'commission_percent',
            // 'companys_revenue',
            // 'daily_productivity_status_id',
            // 'buyer_document',
            // 'buyer_name',
            [
                'attribute' => 'seller_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->seller ? $model->seller->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],             
            [
                'attribute' => 'operator_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->operator ? $model->operator->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
