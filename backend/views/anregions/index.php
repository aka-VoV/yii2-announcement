<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel vov\announcement\backend\models\AnRegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'An Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-regions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create An Regions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'label' => 'parentReg',
                'attribute' => 'parentReg',
                'value' => function($searchModel){
                    $cat = \vov\announcement\backend\models\AnRegions::findOne(['id' => $searchModel->id]);
                    $parentReg = $cat->parents(1)->one();
                    return $parentReg->name;
                },
                'filter' => yii\Helpers\ArrayHelper::map($searchModel->getParents(), 'id', 'name'),
            ],
            [
                'label' => 'local',
                'attribute' => 'local',
                'value' => 'local',
                'filter' => \vov\announcement\common\helpers\NeccFunctions::getLanguages(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
