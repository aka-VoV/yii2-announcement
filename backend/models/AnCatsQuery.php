<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 20.02.2015
 * Time: 10:08
 */

namespace vov\announcement\backend\models;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class AnCatsQuery extends \yii\db\ActiveQuery{

    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }

}