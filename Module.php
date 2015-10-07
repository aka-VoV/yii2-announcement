<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 19.02.2015
 * Time: 11:03
 */

namespace vov\announcement;

use Yii;

class Module extends \yii\base\Module{

    protected $_isBackend;
    // змінна, щоб визначити фронтенд чи бекенд
    public $controllerNamespace = 'vov\announcement\frontend\controllers';

    public function init()
    {
        parent::init();

        if ($this->getIsBackend() === true) {
            $this->setViewPath('@vov/announcement/backend/views');
            // инициализация модуля с помощью конфигурации, загруженной из config/main.php
            \Yii::configure($this, require(__DIR__ . '/backend/config/main.php'));
        } else {
            $this->setViewPath('@vov/announcement/frontend/views');
            \Yii::configure($this, require(__DIR__ . '/frontend/config/main.php'));
        }

        $this->registerTranslations();
    }


    // визначаємо чи це бекенд
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }

    /**
     * Register module translations
     * This method calling during module initialization
     * @return void
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['announcement'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@vov/announcement/messages'
        ];
    }

}