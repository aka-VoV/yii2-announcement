<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use mcms\xeditable\XEditable;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel vov\announcement\backend\models\AnItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'An Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create An Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-hover',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'text',
                'format' => 'raw',
                'value' => function ($searchModel){
                    return '<div class="grid-text">' . $searchModel->text . '</div>';
                },
            ],
            //'cat.name',
            [
                'label' => 'category',
                'attribute' => 'category',
                'value' => 'cat.name',
            ],
            [
                'label' => 'region',
                'attribute' => 'region',
                'value' => 'region.name',
            ],
            //'region.name',
            //'created_at',
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => DatePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                            'class' => 'form-control'
                        ],
                    ]
                )
            ],
            //'status',

            [
                'attribute' => 'status',
                //'format' => 'html',
                'value' => function ($searchModel) {
                    $class = ($searchModel->status === $searchModel::STATUS_PUBLISHED) ? 'label-success' : 'label-danger';

                    switch($searchModel->status){
                        case $searchModel::STATUS_PUBLISHED:
                            $class = 'label-success';
                            break;
                        case $searchModel::STATUS_UNPUBLISHED:
                            $class = 'label-info';
                            break;
                        case $searchModel::STATUS_BANNED:
                            $class = 'label-danger';
                            break;
                        case $searchModel::STATUS_NOT_MODERATING:
                            $class = 'label-warning';
                            break;
                    }
                    return '<span class="label ' . $class . '">' . $searchModel->getStatus() . '</span>';
                },
                'class' => \mcms\xeditable\XEditableColumn::className(),
                'url' => \yii\helpers\Url::toRoute('editable'),
                'dataType'=>'select',
                'editable'=>[
                    'source'=>[
                        ['value'=>0,
                            'text'=>'not moderating'],
                        ['value'=>1,
                            'text'=>'published'],
                        ['value'=>2,
                            'text'=>'unpublished'],
                        ['value'=>3,
                            'text'=>'banned'],
                    ],
                    'placement' => 'inline',
                ],
                //'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    $statusArray,
                    [
                        'class' => 'form-control',
                        'prompt' => '--Select--'
                    ]
                ),
            ],
            // 'local',
            // 'title',
            // 'text:ntext',
            // 'person',
            // 'phone',
            // 'email:email',
            // 'site',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
