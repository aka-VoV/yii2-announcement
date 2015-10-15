<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 24.02.2015
 * Time: 17:13
 */
use yii\widgets\ListView;
use yii\jui\DatePicker;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use vova07\select2\Widget;
use kartik\datetime\DateTimePicker;
use dosamigos\selectize\SelectizeTextInput;


$this->registerJs(
    '$("document").ready(function(){
        $("#annSearchForm").on("pjax:end", function() {
            $.pjax.reload({container:"#listview", timeout: 2000});  //Reload GridView
        });
    });', \yii\web\View::POS_READY
);
?>

<div class="row">
<div class="col-md-9">
    <?Pjax::begin([
        'timeout' => false,
        'id' => 'annSearchForm',
    ]);?>

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'options' => [
                'data-pjax' => 1,
            ],
        ]); ?>

            <div class="row">

                <div class="col-md-3">
                    <?= $form->field($searchModel, 'title')->textInput()?>
                </div>

<!--                <div class="col-md-3">-->
<!--                    --><?//= $form->field($searchModel, 'created_at')->widget(\yii\jui\DatePicker::classname(), [
//                        'language' => \vov\announcement\common\helpers\NeccFunctions::getShortLangFromLanguage(),
//                        'dateFormat' => 'yyyy-MM-dd',
//                        'options' => [
//                            'class' => 'form-control'
//                        ],
//                    ]) ?>
<!--                </div>-->

                <div class="col-md-3">
                    <?= $form->field($searchModel, 'created_at')->widget(DateTimePicker::className(),[
                        'options' => ['placeholder' => Yii::t('announcement', 'Select publication date')],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'viewSelect'=> 'month',
                            'autoclose' => true,
                            'todayHighlight' => true
                        ]
                    ]) ?>
                </div>

                <div class="col-md-3">
                    <?php
                    echo $form->field($searchModel, 'category')->widget(Widget::className(), [
                        'options' => [
                            'multiple' => true,
                            'placeholder' => Yii::t('announcement', 'Choose category'),
                            'class' => 'form-control',
                        ],
                        'bootstrap' => true,
                        'settings' => [
                            'width' => '100%',
                        ],
                        'items' => $categories, //yii\Helpers\ArrayHelper::map($categories, 'id', 'name'),

                    ]);
                    ?>
                </div>

                <div class="col-md-3">
                    <?php
                    echo $form->field($searchModel, 'region')->widget(Widget::className(), [
                        'options' => [
                            'multiple' => true,
                            'placeholder' => Yii::t('announcement', 'Choose region'),
                            'class' => 'form-control',
                        ],
                        'settings' => [
                            'width' => '100%',
                        ],
                        'items' => $regions,
                    ]);
                    ?>
                </div>

                <div class="col-md-12">
                    <?= Html::submitButton(Yii::t('yii', 'Search'),[
                        'class'=> 'btn btn-default'
                    ]) ?>
                </div>

            <?php ActiveForm::end(); ?>

        <?Pjax::end();?>

    </div>

    <p>&nbsp;</p>

    <?Pjax::begin([
        'id' => 'listview',
        'enablePushState' => false,
    ]);?>

        <ul class="list-group">
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'post'],
                'layout' => '{items}{pager}',
                'itemView' => '_view',
            ]);
            ?>
        </ul>

    <?Pjax::end();?>
</div>

<div class="col-md-3">
    <div class="col-md-12 menu">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= yii\helpers\Url::toRoute('announcement/anitems/create')?>" class="btn btn-success btn-success-blue">Додати оголошення</a>
            </div>
            <div class="visible-xs-12">
                <hr/>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <? if ($categories): ?>
                        <?php Pjax::begin([
                            'id' => 'searchByCat',
                            'timeout' => false,
                        ]);?>
                        <?foreach($categories as $key => $value):?>
                            <?if(is_array($value)):?>
                                <div class="col-md-12 col-xs-4">
                                    <h3><?=$key?>:</h3>
                                    <?foreach($value as $k => $v):?>
                                        <p><a href="/<?= explode('-', Yii::$app->language)[0];?>/?<?= urlencode('AnItemsSearch[category][]')?>=<?=$k;?>"><?=$v;?></a></p>
                                    <?endforeach;?>
                                </div>
                            <?endif;?>
                        <?endforeach;?>
                        <?Pjax::end();?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>