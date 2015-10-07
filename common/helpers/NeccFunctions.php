<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 17.03.2015
 * Time: 11:05
 */

namespace vov\announcement\common\helpers;

use yii\Helpers\ArrayHelper;


class NeccFunctions {

    // формуємо правильний масив даних для select форми
    public function getCorrectList($parentCats){
        $list = array();
        foreach ($parentCats as $parentCat) {
            $list[$parentCat->name] = $this->getLeavesForDropDownList($parentCat);
        }
        return $list;
    }

    // вибираємо всіх дітей головної категорії
    private function getLeavesForDropDownList($parentCat){
        $leaves = $parentCat->leaves()->all();
        return ArrayHelper::map($leaves, 'id', 'name');
    }

    // вибираємо коротку назва із мови
    public static function getShortLangFromLanguage(){

        if(\Yii::$app->language == 'uk-UA'){
            $Languages[0] = 'uk';
        }else{
            $Languages = explode('-', \Yii::$app->language);
        }

        return $Languages[0];

    }

    /**
     * Get current app language code
     * @return string
     */
    public function getAppLanguageCode()
    {
        if (preg_match('/-/', Yii::$app->language)) {
            return explode('-', Yii::$app->language)[0];
        } else {
            return Yii::$app->language;
        }
    }

    public static function getLanguages(){

        if(isset(\Yii::$app->i18n->languages) && !empty(\Yii::$app->i18n->languages)){
            $languages = array_combine(\Yii::$app->i18n->languages, \Yii::$app->i18n->languages);
        }else{
            $languages = array(
                'uk-UA' => 'Українська',
                'ru-RU' => 'Русский',
                'en-US' => 'English',
            );
        }
        return $languages;

    }

}