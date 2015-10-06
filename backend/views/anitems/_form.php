<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="an-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_id')->dropDownList($cats) ?>

    <?= $form->field($model, 'region_id')->dropDownList($regions) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'buttons' => ['bold', 'italic', 'unorderedlist', 'orderedlist']
        ]
    ]);  ?>

    <?= $form->field($model, 'person')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
