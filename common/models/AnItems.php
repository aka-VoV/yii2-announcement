<?php

namespace vov\announcement\common\models;

use vov\announcement\Module;
use vov\announcement\backend\models\AnCats;
use vov\announcement\backend\models\AnRegions;
use Yii;
use yii\helpers\HtmlPurifier;

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
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 2;
    const STATUS_BANNED = 3;

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
            self::STATUS_PUBLISHED => 'STATUS_PUBLISHED', //Module::t('announcement', 'STATUS_PUBLISHED')
            self::STATUS_UNPUBLISHED => 'STATUS_UNPUBLISHED', //Module::t('announcement', 'STATUS_UNPUBLISHED'),
            self::STATUS_BANNED => 'STATUS_BANNED', //Module::t('announcement', 'STATUS_BANNED'),
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
            'id' => \vov\announcement\Module::t('common/model', 'ID'),
            'cat_id' => \vov\announcement\Module::t('common/model', 'Category ID'),
            'region_id' => \vov\announcement\Module::t('common/model', 'Region ID'),
            'created_at' => \vov\announcement\Module::t('common/model', 'Created at'),
            'status' => \vov\announcement\Module::t('common/model', 'Status'),
            'local' => \vov\announcement\Module::t('common/model', 'Local'),
            'title' => \vov\announcement\Module::t('common/model', 'Title'),
            'text' => \vov\announcement\Module::t('common/model', 'Text'),
            'person' => \vov\announcement\Module::t('common/model', 'Person'),
            'phone' => \vov\announcement\Module::t('common/model', 'Phone'),
            'email' => \vov\announcement\Module::t('common/model', 'Email'),
            'site' => \vov\announcement\Module::t('common/model', 'Site'),
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
