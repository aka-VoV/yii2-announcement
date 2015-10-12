<?php

namespace vov\announcement\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnRegions;
use vov\announcement\common\models\AnItems;
use vov\announcement\common\models\AnItemsSearch;
use vov\announcement\common\helpers\NeccFunctions;


/**
 * AnItemsController implements the CRUD actions for AnItems model.
 */
class AnItemsController extends Controller
{

    public $items;
    public $categories;
    public $regions;
    public $searchModel;
    public $dataProvider;

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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Lists all AnItems models.
     * @return mixed
     */
    public function actionIndex()
    {

        $NeccFunc = new NeccFunctions();

        // вибираємо головних батьків
        $parentCats = AnCats::find()->roots()->all();
        $parentRegs = AnRegions::find()->roots()->all();

        $this->categories = $NeccFunc->getCorrectList($parentCats);
        $this->regions = $NeccFunc->getCorrectList($parentRegs);

        // add parent category to search
//        foreach($parentCats as $cats){
//            $this->categories[$cats->id] = $cats->name;
//        }

        // пошукові запроси, якщо такі є
        $this->searchModel = new AnItemsSearch();
        $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);

        return $this->render('announcement', [
            'searchModel' => $this->searchModel,
            'dataProvider' => $this->dataProvider,
            'categories' => $this->categories,
            'regions' => $this->regions,
            //'statusArray' => $statusArray,
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
        $NeccFunc = new NeccFunctions();


        // вибираємо головних батьків
        $parentCats = AnCats::find()->roots()->all();
        $list = $NeccFunc->getCorrectList($parentCats);

        // вибираємо регіони
        $regionsQuery = AnRegions::find()
            ->asArray()
            ->all();
        $regions = array();

        // формую правильний масив для select форми
        // хоча потрібно було б використати ArrayHelper::map($array, 'key', 'key')
        foreach($regionsQuery as $region){
            $regions[$region['id']] = $region['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->created_at = DATE('Y-m-d H:i:s');
            $model->status = 0;
            $model->local = Yii::$app->language;
            $model->save();
            return $this->redirect('/announcement/anitems');

        } else {
            return $this->render('create', [
                'model' => $model,
                'regions' => $regions,
                'list' => $list,
            ]);
        }
    }

//    // формуємо правильний масив даних для select форми
//    private function getCorrectList($parentCats){
//        foreach ($parentCats as $parentCat) {
//            $list[$parentCat->name] = $this->getLeavesForDropDownList($parentCat);
//        }
//        return $list;
//    }
//
//    // вибираємо всіх дітей головної категорії
//    private function getLeavesForDropDownList($parentCat){
//        $leaves = $parentCat->leaves()->all();
//        return ArrayHelper::map($leaves, 'id', 'name');
//    }

    /**
     * Updates an existing AnItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing AnItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

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
