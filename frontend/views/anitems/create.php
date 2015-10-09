<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnItems */

$this->title = Yii::t('yii', 'Create').' '.Yii::t('announcement', 'announcement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('announcement', 'announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Create');
?>

    <div class="row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'list' => $list,
    ]) ?>

    </div>

