<?php

namespace vov\announcement\backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vov\announcement\backend\models\AnRegions;
use vov\announcement\backend\models\AnRegionsSearch;

/**
 * AnRegionsController implements the CRUD actions for AnRegions model.
 */
class AnRegionsController extends Controller
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

    /**
     * Lists all AnRegions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnRegionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnRegions model.
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
     * Creates a new AnRegions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnRegions();
        $regionsQuery = AnRegions::find()
            ->asArray()
            ->all();
        $regions = array();
        $regions[0] = 'Немає';

        foreach($regionsQuery as $region){
            $regions[$region['id']] = $region['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $formsData = Yii::$app->request->post();
            $formsData = $formsData['AnRegions'];
            if($formsData['parentReg'] == 0){
                $reg = new AnRegions([
                    'name' => $formsData['name'],
                    'local' => $formsData['local']
                ]);
                $reg->makeRoot();
            }else{
                $parent = AnRegions::findOne(['id' => $formsData['parentReg']]);
                $reg = new AnRegions([
                    'name' => $formsData['name'],
                    'local' => $formsData['local']
                ]);
                $reg->appendTo($parent);
            }

            return $this->redirect(['view', 'id' => $reg->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'regions' => $regions,
            ]);
        }
    }

    /**
     * Updates an existing AnRegions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->getParentReg();
        $regionsQuery = AnRegions::find()
            ->asArray()
            ->all();
        $regions = array();
        $regions[0] = 'Немає';

        foreach($regionsQuery as $region){
            $regions[$region['id']] = $region['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $formsData = Yii::$app->request->post();
            $formsData = $formsData['AnRegions'];
            if($formsData['parentReg'] == 0){
                $reg = AnRegions::findOne([
                    'name' => $formsData['name']
                ]);
                $reg->local = $formsData['local'];
                $reg->makeRoot();
            }else{
                $parent = AnRegions::findOne(['id' => $formsData['parentReg']]);
                $reg = AnRegions::findOne([
                    'name' => $formsData['name']
                ]);
                $reg->local = $formsData['local'];
                $reg->appendTo($parent);
            }

            return $this->redirect(['view', 'id' => $reg->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'regions' => $regions,
            ]);
        }
    }

    /**
     * Deletes an existing AnRegions model.
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
     * Finds the AnRegions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnRegions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnRegions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
