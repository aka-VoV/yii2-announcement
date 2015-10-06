<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnCats */

$this->title = 'Update An Cats: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'An Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="an-cats-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats,
    ]) ?>

</div>
