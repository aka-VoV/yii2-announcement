<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 24.02.2015
 * Time: 16:38
 */

namespace vov\announcement\widgets;

use Yii;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnRegions;
use vov\announcement\frontend\models\AnItemsSearch;
use vov\announcement\common\helpers\NeccFunctions;


class Announcement extends \yii\base\Widget{

    public $items;
    public $categories;
    public $regions;
    public $searchModel;
    public $dataProvider;
    public $perPage;

    public function init(){

        parent::init();

        $NeccFunc = new NeccFunctions();

        $perPage = ($this->perPage) ? $this->perPage: 10;

        // вибираємо головних батьків
        $parentCats = AnCats::find()
            ->where(['local' => Yii::$app->language])
            ->roots()
            ->all();
        $this->categories = $NeccFunc->getCorrectList($parentCats);

        foreach($parentCats as $cats){
            $this->categories[$cats->id] = $cats->name;
        }

        // виборка категорій та регіонів
        //$this->categories = AnCats::find()->addOrderBy('tree')->addOrderBy('lft')->all();
        $parentRegs = AnRegions::find()->roots()->all();
        $this->regions = $NeccFunc->getCorrectList($parentRegs);

        //$this->regions = AnRegions::find()->addOrderBy('tree')->addOrderBy('lft')->all();

        // пошукові запроси, якщо такі є
        $this->searchModel = new AnItemsSearch();
        $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams, $perPage);
        $this->registerTranslations();

    }

    public function run(){
        return $this->render('announcement',[
            'items'=> $this->items,
            'categories'=> $this->categories,
            'regions'=> $this->regions,
            'searchModel'=> $this->searchModel,
            'dataProvider'=> $this->dataProvider,
        ]);
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['announcement'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@vov/announcement/messages'
        ];
    }

}