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
    });', \yii\web\View::POS_READY
);
?>



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

                <div class="col-md-3">
                    <?= $form->field($searchModel, 'created_at')->widget(\yii\jui\DatePicker::classname(), [
                        'language' => \vov\announcement\common\helpers\NeccFunctions::getShortLangFromLanguage(),
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                            'class' => 'form-control'
                        ],
                    ]) ?>
                </div>

                <div class="col-md-3">
                    <?php
                    echo $form->field($searchModel, 'category')->widget(Widget::className(), [
                        'options' => [
                            'multiple' => true,
                            'placeholder' => \vov\announcement\Module::t('frontend', 'Choose item'),
                        ],
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
                            'placeholder' => \vov\announcement\Module::t('frontend', 'Choose item'),
                        ],
                        'settings' => [
                            'width' => '100%',
                        ],
                        'items' => yii\Helpers\ArrayHelper::map($regions, 'id', 'name'),
                    ]);
                    ?>
                </div>

                <div class="col-md-12">
                    <?= Html::submitButton(\vov\announcement\Module::t('frontend', 'Search'),[
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

