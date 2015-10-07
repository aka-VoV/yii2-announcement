<?php

namespace vov\announcement\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnRegions;
use vov\announcement\common\models\AnItems;
use vov\announcement\common\models\AnItemsSearch;

/**
 * AnItemsController implements the CRUD actions for AnItems model.
 */
class AnItemsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'editable' => [
                'class' => 'mcms\xeditable\XEditableAction',
                //'scenario'=>'editable',  //optional
                'modelclass' => AnItemsSearch::className(),
            ],
        ];
    }

    /**
     * Lists all AnItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnItemsSearch();
        $statusArray = AnItems::getStatusArray();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusArray' => $statusArray,
        ]);
    }

    /**
     * Displays a single AnItems model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnItems();

        $catsQuery = AnCats::find()
            ->asArray()
            ->all();

        $cats = array();
        foreach($catsQuery as $cat){
            $cats[$cat['id']] = $cat['name'];
        }

        $regionsQuery = AnRegions::find()
            ->asArray()
            ->all();
        $regions = array();

        foreach($regionsQuery as $region){
            $regions[$region['id']] = $region['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->created_at = DATE('Y-m-d H:i:s');
            $model->status = 0;
            $model->local = Yii::$app->language;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
                'cats' => $cats,
                'regions' => $regions,
            ]);
        }
    }

    /**
     * Updates an existing AnItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
