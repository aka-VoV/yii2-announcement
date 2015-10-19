<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 16.10.2015
 * Time: 17:14
 */

namespace vov\announcement\assets;

use yii\web\AssetBundle;
use yii\web\View;
use Yii;

class AnnouncementAsset extends AssetBundle
{
    public $sourcePath = '';
    public $css = [
        'css/common.css',
    ];
    public $js = [
        'js/common.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    /**
     * @inheritdoc
     */
    public function init() {
        $this->sourcePath = __DIR__;
        parent::init();
    }
}