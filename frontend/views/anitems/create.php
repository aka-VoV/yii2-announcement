<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnItems */

$this->title = \vov\announcement\Module::t('frontend', 'Create An Items');
$this->params['breadcrumbs'][] = ['label' => \vov\announcement\Module::t('frontend', 'An Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="block">
        <header><h1>Оголошення</h1></header>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'list' => $list,
    ]) ?>

    </div>

