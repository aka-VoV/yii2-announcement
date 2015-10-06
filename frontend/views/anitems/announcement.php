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
use vova07\select2\Widget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerJs(
    '$("document").ready(function(){
        $("#annSearchForm").on("pjax:end", function() {
            $.pjax.reload({container:"#listview", timeout: 2000});  //Reload GridView
        });
        $("#searchByCat").on("pjax:end", function() {
            $.pjax.reload({container:"#listview", timeout: 2000});  //Reload GridView
        });
    });', \yii\web\View::POS_READY
); ?>

<div class="announcement">
    <div class="row">
        <div class="col-sm-9">


            <?Pjax::begin([
                'timeout' => false,
                'id' => 'annSearchForm',
            ]);
            ?>

<!--            <div class="panel panel-default">-->
<!---->
<!--                --><?//
//            $form = ActiveForm::begin([
//                'method' => 'get',
//                'options' => [
//                    'data-pjax' => 1,
//                ],
//            ]); ?>
<!--                <p>&nbsp;</p>-->
<!---->
<!---->
<!---->
<!--                    <div class="col-sm-3">-->
<!--                        --><?//= $form->field($searchModel, 'title')->textInput()?>
<!--                    </div>-->
<!--                    <div class="col-sm-3">-->
<!--                        --><?//= $form->field($searchModel, 'created_at')->widget(\yii\jui\DatePicker::classname(), [
//                            'language' => \vov\announcement\common\helpers\NeccFunctions::getShortLangFromLanguage(),
//                            'dateFormat' => 'yyyy-MM-dd',
//                            'options' => [
//                                'class' => 'form-control'
//                            ],
//                        ]) ?>
<!--                    </div>-->
<!--                    <div class="col-sm-3">-->
<!--                        --><?php
//                        echo $form->field($searchModel, 'category')->widget(Widget::className(), [
//                            'options' => [
//                                'multiple' => true,
//                                'placeholder' => \vov\announcement\Module::t('frontend', 'Choose item'),
//                            ],
//                            'settings' => [
//                                'width' => '100%',
//                            ],
//                            'items' => ( $categories ) ?  $categories : ['nothing'] , //yii\Helpers\ArrayHelper::map($categories, 'id', 'name'),
//                        ]);
//                        ?>
<!--                    </div>-->
<!--                    <div class="col-sm-3">-->
<!--                        --><?php
//                        echo $form->field($searchModel, 'region')->widget(Widget::className(), [
//                            'options' => [
//                                'multiple' => true,
//                                'placeholder' => \vov\announcement\Module::t('frontend', 'Choose item'),
//                            ],
//                            'settings' => [
//                                'width' => '100%',
//                            ],
//                            'items' => yii\Helpers\ArrayHelper::map($regions, 'id', 'name'),
//                        ]);
//                        ?>
<!--                    </div>-->
<!--                    <div class="col-sm-12">-->
<!--                        --><?//= Html::submitButton(\vov\announcement\Module::t('frontend', 'Search'),[
//                            'class'=> 'btn btn-default'
//                        ]) ?>
<!--                    </div>-->
<!---->
<!---->
<!--                <p>&nbsp;</p>-->
<!---->
<!--            --><?php //ActiveForm::end();?>
<!---->
<!--            </div>-->

            <?Pjax::end();

            Pjax::begin([
                'id' => 'listview',
                'enablePushState' => false,
            ]);

            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'post'],
                'layout' => '{items}<div class="col-sm-12">{pager}</div>',
                'itemView' => '_view',
            ]);

            Pjax::end();?>
        </div>

        <div class="col-sm-3">
            <div class="col-sm-12 menu" data-spy="affix">

                <a href="<?= yii\helpers\Url::toRoute('/announcement/create')?>" class="btn btn-success">Додати оголошення</a>

                <? if ($categories): ?>
                <?php Pjax::begin([
                    'id' => 'searchByCat',
                    'timeout' => false,
                    'scrollTo' => 10
                ]);?>
                <?foreach($categories as $key => $value):?>
                    <?if(is_array($value)):?>
                        <h3><?=$key?>:</h3>
                        <?foreach($value as $k => $v):?>
                <p><a href="?<?= urlencode('AnItemsSearch[category][]')?>=<?=$k;?>"><?=$v;?></a></p>
                        <?endforeach;?>
                    <?endif;?>
                <?endforeach;?>
                <?Pjax::end();?>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>





