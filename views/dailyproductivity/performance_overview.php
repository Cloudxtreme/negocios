<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Product;
use app\models\Modality;
use app\models\User;
use yii\data\SqlDataProvider;
use yii\helpers\Url;
use yii\web\View;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'Produtividade Diária';
// SELECT t2.name AS PRODUTO, SUM(t1.value) AS TOTAL
// FROM daily_productivity AS t1
// LEFT JOIN product AS t2 ON t1.product_id = t2.id 
// GROUP BY PRODUTO
?>
<div class="dailyproductivity-index">

<div class="row">
  <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
  <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
</div>

<hr/>

<div class="row">	
  <div class="col-xs-2 pull-right">	
			<?php
                $array = [
                    ['id' => '01', 'name' => 'Janeiro'],
                    ['id' => '02', 'name' => 'Fevereiro'],
                    ['id' => '03', 'name' => 'Março'],
                    ['id' => '04', 'name' => 'Abril'],
                    ['id' => '05', 'name' => 'Maio'],
                    ['id' => '06', 'name' => 'Junho'],
                    ['id' => '07', 'name' => 'Julho'],
                    ['id' => '08', 'name' => 'Agosto'],
                    ['id' => '09', 'name' => 'Setembro'],
                    ['id' => '10', 'name' => 'Outubro'],
                    ['id' => '11', 'name' => 'Novembro'],
                    ['id' => '12', 'name' => 'Dezembro'],
                ];
                //$result = ArrayHelper::map($array, 'id', 'name');
                $this->registerJs('var submit = function (val){if (val > 0) {
                    window.location.href = "' . Url::to(['/dailyproductivity/performance_overview']) . '&mounth=" + val;
                }
                }', View::POS_HEAD);
               echo Html::activeDropDownList($model, 'mounth', ArrayHelper::map($array, 'id', 'name'),['onchange'=>'submit(this.value);','class'=>'form-control']);
            ?>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  	<div class="panel panel-primary">
	  <div class="panel-heading"><b>Produtos Mais Vendidos por Receita</b></div>
	  <div class="panel-body">
		<?php
		echo Highcharts::widget([
		                    'options' => [
		                        'credits' => ['enabled' => false],
		                        'title' => [
		                            'text' => '',
		                        ],
		                        'colors'=> ['#00A295','#27cdd9'],
		                        'xAxis' => [
		                            //'categories' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Nov', 'Dez'],
		                            'categories' => $p,
		                        ],
		                        'yAxis' => [
		                            'min' => 0,
		                            'title' => '',
		                        ],                        
		                        'series' => [
		                            [
		                                'type' => 'column',
		                                'name' => 'Produtos',
		                                'data' => $t,
		                            ],
		                            // [
		                            //     'type' => 'spline',
		                            //     'name' => 'Evolução',
		                            //     'data' => $quantity,
		                            //     'marker' => [
		                            //         'lineWidth' => 2,
		                            //         'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
		                            //         'fillColor' => 'white',
		                            //     ],
		                            // ],                           
		                        ],
		                    ]
		                ]);
		?>
	  </div>
	</div>
  </div>

  <div class="col-md-6">
  	<div class="panel panel-primary">
	  <div class="panel-heading"><b>Produtos Mais Vendidos por Volume</b></div>
	  <div class="panel-body">
		<?php
		echo Highcharts::widget([
		            'options' => [
		                'credits' => ['enabled' => false],
		                'title' => [
		                    'text' => '',
		                ],
		                'colors'=> ['#00A295','#27cdd9'],
		                'xAxis' => [
		                    'categories' => $p,
		                ],
		                'yAxis' => [
		                    'min' => 0,
		                    'title' => '',
		                ],                        
		                'series' => [
		                    [
		                        'type' => 'column',
		                        'name' => 'Volume',
		                        'data' => $q,
		                    ],
		                    // [
		                    //     'type' => 'spline',
		                    //     'name' => 'Evolução',
		                    //     'data' => $quantity,
		                    //     'marker' => [
		                    //         'lineWidth' => 2,
		                    //         'lineColor' => new JsExpression('Highcharts.getOptions().colors[7]'),
		                    //         'fillColor' => 'white',
		                    //     ],
		                    // ],                           
		                ],
		            ]
		        ]);
		?>	    
	  </div>
	</div>
  </div>

  <?php
  //var_dump($t);
  ?>
</div>

</div>