<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\components\DataRekananWidget;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TVendorLegalSiupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SIUP';
$this->params['breadcrumbs'][] = ['label' => 'Data Rekanan', 'url' => ['data-vendor/index']];
$this->params['breadcrumbs'][] = ['label' => 'Data Legal', 'url' => ['data-vendor/data-legal']];
$this->params['breadcrumbs'][] = $this->title;
echo DataRekananWidget::widget(['controller' => Yii::$app->controller->id]);
?>
<div class="panel panel-default">
  <div class="panel-heading">
      <h1><?= Html::encode($this->title) ?></h1>
  </div>
  <div class="panel-body tvendor-legal-siup-index">
    <p>
        <?= Html::a('Tambah Siup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'penerbit',
            'nomor',
            'jenis',
            'kadaluarsa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
  </div>
</div>
