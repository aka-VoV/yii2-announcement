<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel vov\announcement\backend\models\AnCatsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'An Cats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="an-cats-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create An Cats', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',
            [
                'label' => 'parentCat',
                'attribute' => 'parentCat',
                'value' => function($searchModel){
                    $cat = \vov\announcement\backend\models\AnCats::findOne(['id' => $searchModel->id]);
                    $parentCat = $cat->parents(1)->one();
                    return $parentCat->name;
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
