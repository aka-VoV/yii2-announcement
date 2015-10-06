<?php

namespace vov\announcement\backend\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use vov\announcement\common\models\AnItems;

/**
 * This is the model class for table "an_regions".
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
class AnRegions extends \yii\db\ActiveRecord
{

    public $parentReg;

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

    public function getParentReg(){
        $reg = AnRegions::findOne(['id' => $this->id]);
        $this->parentReg = $reg->parents(1)->one();
        //return $parentCat;
    }

    public function getParents(){
        return AnRegions::find()->roots()->all();
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
        return '{{%an_regions}}';
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
        return $this->hasMany(AnItems::className(), ['region_id' => 'id']);
    }
}
