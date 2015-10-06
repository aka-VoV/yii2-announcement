<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnRegions */

$this->title = 'Create An Regions';
$this->params['breadcrumbs'][] = ['label' => 'An Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-regions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
    ]) ?>

</div>
