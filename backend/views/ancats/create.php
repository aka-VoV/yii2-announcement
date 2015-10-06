<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnCats */

$this->title = 'Create An Cats';
$this->params['breadcrumbs'][] = ['label' => 'An Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-cats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats' => $cats,
    ]) ?>

</div>
