<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\captcha\Captcha;


/* @var $this yii\web\View */
/* @var $model vov\announcement\backend\models\AnItems */
/* @var $form yii\widgets\ActiveForm */

?>


            <div class="col-sm-12 an-items-form">

                <?php $form = ActiveForm::begin(); ?>


                <div class="row">
                    <div class="col-md-6">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => 500]) ?>

                        <?= $form->field($model, 'text')->widget(Widget::className(), [
                            'settings' => [
                                'lang' => \vov\announcement\common\helpers\NeccFunctions::getShortLangFromLanguage(),
                                'minHeight' => 200,
                                'buttons' => ['bold', 'italic', 'unorderedlist', 'orderedlist']
                            ]
                        ]); ?>


                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'captchaAction' => '/announcement/anitems/captcha',
                            'options' => ['style' => 'width:30%', 'class' => 'form-control'],
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9"><div class="field">{input}</div></div></div>',
                        ]) ?>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'cat_id')->dropDownList($list, ['prompt' => Yii::t('announcement', '--Select--')]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'region_id')->dropDownList($regions, ['prompt' => Yii::t('announcement', '--Select--')]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'person')->textInput(['maxlength' => 255]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'phone')->textInput(['maxlength' => 255]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'site')->textInput(['maxlength' => 255]) ?>
                            </div>
                        </div>
                    </div>
                </div>









                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('announcement', 'Create') : Yii::t('announcement', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

