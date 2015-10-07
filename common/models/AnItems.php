<?php

namespace vov\announcement\common\models;

use Yii;
use yii\helpers\HtmlPurifier;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnRegions;

/**
 * This is the model class for table "an_items".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $region_id
 * @property string $created_at
 * @property integer $status
 * @property string $local
 * @property string $title
 * @property string $text
 * @property string $person
 * @property string $phone
 * @property string $email
 * @property string $site
 *
 * @property AnRegions $region
 * @property AnCats $cat
 */
class AnItems extends \yii\db\ActiveRecord
{
    const STATUS_NOT_MODERATING = 0;
    const STATUS_PUBLISHED      = 1;
    const STATUS_UNPUBLISHED    = 2;
    const STATUS_BANNED         = 3;

    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%an_items}}';
    }

    public function getStatus()
    {
        $statuses = self::getStatusArray();

        return $statuses[$this->status];
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_NOT_MODERATING => 'STATUS_NOT_MODERATING', //Module::t('announcement', 'STATUS_NOT_MODERATING'),
            self::STATUS_PUBLISHED      => 'STATUS_PUBLISHED', //Module::t('announcement', 'STATUS_PUBLISHED')
            self::STATUS_UNPUBLISHED    => 'STATUS_UNPUBLISHED', //Module::t('announcement', 'STATUS_UNPUBLISHED'),
            self::STATUS_BANNED         => 'STATUS_BANNED', //Module::t('announcement', 'STATUS_BANNED'),
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['cat_id', 'region_id', 'created_at', 'status', 'local', 'title', 'text', 'person', 'phone', 'email', 'site'], 'required'],
            [['cat_id', 'region_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string'],
            [['local'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 500],
            [['person', 'phone', 'email', 'site'], 'string', 'max' => 255],
            [['phone'], 'match', 'pattern'=>'/^((8|0|\+\d{1,2})[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
            [['email'], 'email'],
            ['verifyCode', 'captcha', 'captchaAction' => '/announcement/anitems/captcha', 'caseSensitive' => false,],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('announcement', 'ID'),
            'cat_id'        => Yii::t('announcement', 'Category ID'),
            'region_id'     => Yii::t('announcement', 'Region ID'),
            'created_at'    => Yii::t('announcement', 'Created at'),
            'status'        => Yii::t('announcement', 'Status'),
            'local'         => Yii::t('announcement', 'Local'),
            'title'         => Yii::t('announcement', 'Title'),
            'text'          => Yii::t('announcement', 'Text'),
            'person'        => Yii::t('announcement', 'Person'),
            'phone'         => Yii::t('announcement', 'Phone'),
            'email'         => Yii::t('announcement', 'Email'),
            'site'          => Yii::t('announcement', 'Site'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(AnRegions::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(AnCats::className(), ['id' => 'cat_id']);
    }

    public function beforeSave($insert){

        parent::beforeSave(true);
        $this->text = HtmlPurifier::process($this->text, [
            'HTML.Allowed' => 'p, b, ul, ol, li, em',
            'AutoFormat.AutoParagraph' => true,
        ]);
        return true;

    }

}
