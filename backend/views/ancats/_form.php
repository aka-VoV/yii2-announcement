<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnCats */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="an-cats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parentCat')->dropDownList($cats) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'local')->dropDownList(\vov\announcement\common\helpers\NeccFunctions::getLanguages()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
