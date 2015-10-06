<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnItems */

$this->title = 'Create An Items';
$this->params['breadcrumbs'][] = ['label' => 'An Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats,
        'regions' => $regions,
    ]) ?>

</div>
