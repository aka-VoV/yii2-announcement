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

    // перевод повідомлень в модулі
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('vov/announcement/' . $category, $message, $params, $language);
    }

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
    }


    // визначаємо чи це бекенд
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }

}