<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\components\DataRekananWidget;

/* @var $this yii\web\View */
/* @var $model frontend\models\TVendorLegalSiup */

$this->title = 'Detail SIUP';
$this->params['breadcrumbs'][] = ['label' => 'Data Rekanan', 'url' => ['data-vendor/index']];
$this->params['breadcrumbs'][] = ['label' => 'Data Legal', 'url' => ['data-vendor/data-legal']];
$this->params['breadcrumbs'][] = ['label' => 'SIUP', 'url' => [Yii::$app->controller->id.'/index']];
$this->params['breadcrumbs'][] = $this->title;
echo DataRekananWidget::widget(['controller' => Yii::$app->controller->id]);
?>
<div class="panel panel-default">
  <div class="panel-heading">
      <h1><?= Html::encode($this->title) ?></h1>
  </div>
  <div class="panel-body tvendor-legal-siup-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->t_vendor_legal_siup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->t_vendor_legal_siup_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'penerbit',
            'nomor',
            'jenis',
            'tanggal',
            'kadaluarsa',
            //'lampiran',
            [
                'attribute'=>'lampiran',
                'format'=>'raw',
                'value'=> $model->lampiran ? Html::a('download', ['uploads/'.$model->lampiran]) : '',
            ],
        ],
    ]) ?>
  </div>
</div>
