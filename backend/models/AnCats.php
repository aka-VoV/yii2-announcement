<?php

namespace vov\announcement\backend\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * This is the model class for table "an_cats".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property string $local
 *
 * @property AnItems[] $anItems
 */
class AnCats extends \yii\db\ActiveRecord
{

    public $parentCat;

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function getParentCat(){
        $cat = AnCats::findOne(['id' => $this->id]);
        $this->parentCat = $cat->parents(1)->one();
    }

    public function getParents(){
        return AnCats::find()->roots()->all();
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new AnCatsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%an_cats}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['tree', 'lft', 'rgt', 'depth', 'name', 'local'], 'required'],
            [['tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['local'], 'string', 'max' => 55]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
            'local' => 'Local',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnItems()
    {
        return $this->hasMany(AnItems::className(), ['cat_id' => 'id']);
    }
}
