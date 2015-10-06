<?php

namespace vov\announcement\backend\controllers;

use Yii;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnCatsSearch;
use vov\announcement\backend\models\AnCatsQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnCatsController implements the CRUD actions for AnCats model.
 */
class AnCatsController extends Controller
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
     * Lists all AnCats models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnCatsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTest(){
        $countries = new AnCats(['name' => 'Peoples']);
        $countries->makeRoot();

//        $countries = AnCats::findOne(['name' => 'Countries']);
//        $russia = new AnCats(['name' => 'Russia']);
//        $russia->prependTo($countries);
        $x=1;
    }

    /**
     * Displays a single AnCats model.
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
     * Creates a new AnCats model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnCats();
        $catsQuery = AnCats::find()
            ->asArray()
            ->all();

        $cats = array();
        $cats[0] = 'Немає';
        foreach($catsQuery as $cat){
            $cats[$cat['id']] = $cat['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $formsData = Yii::$app->request->post();
            $formsData = $formsData['AnCats'];
            if($formsData['parentCat'] == 0){
                $cat = new AnCats([
                    'name' => $formsData['name'],
                    'local' => $formsData['local']
                ]);
                $cat->makeRoot();
            }else{
                $parent = AnCats::findOne(['id' => $formsData['parentCat']]);
                $cat = new AnCats([
                    'name' => $formsData['name'],
                    'local' => $formsData['local']
                ]);
                $cat->appendTo($parent);
            }
            return $this->redirect(['view', 'id' => $cat->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
                'cats' => $cats,
            ]);
        }
    }

    /**
     * Updates an existing AnCats model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->getParentCat();

        $catsQuery = AnCats::find()
            ->asArray()
            ->all();

        $cats = array();
        $cats[0] = 'Немає';
        foreach($catsQuery as $cat){
            $cats[$cat['id']] = $cat['name'];
        }

        if ($model->load(Yii::$app->request->post())) {

            $formsData = Yii::$app->request->post();
            $formsData = $formsData['AnCats'];
            if($formsData['parentCat'] == 0){
                $cat = AnCats::findOne([
                    'id' => $id,
                ]);
                $cat->local = $formsData['local'];
                $cat->makeRoot();
            }else{
                $parent = AnCats::findOne(['id' => $formsData['parentCat']]);
                $cat = AnCats::findOne([
                    'id' => $id,
                ]);
                $cat->local = $formsData['local'];
                $cat->appendTo($parent);
            }
            return $this->redirect(['view', 'id' => $cat->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'cats' => $cats,
            ]);
        }
    }

    /**
     * Deletes an existing AnCats model.
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
     * Finds the AnCats model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnCats the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnCats::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
