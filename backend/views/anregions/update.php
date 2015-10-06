<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnRegions */

$this->title = 'Update An Regions: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'An Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="an-regions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
    ]) ?>

</div>
