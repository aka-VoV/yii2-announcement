Yii2-Announcement
=======
Announcement module allows you to have announcement board with infinitely nested categories and regions


----------


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vov/yii2-announcement "*"
```

or add

```
"vov/yii2-announcement": "*"
```


Migration
======
you can use migrations that already exist in console/migartions

```
	$ yii migrate --migrationPath='@vov/announcement/console/migrations'
```
or
```
	$ yii migrate --migrationPath=@vendor/vov/yii2-announcement/console/migrations
```

it will create the tables:
	1. an_cats - categories
	2. an_regions - with data of all regions of Ukraine (uk-UA)
	3. an_items - advertisement



Configuring
======
Configure common/config as follows

```
    'modules' => [
        'announcement' => [
            'class' => 'vov\announcement\Module',
        ],
    ],
```
Configure backend/config as follows

```
    'modules' => [
        'announcement' => [
            'controllerNamespace' => 'vov\announcement\backend\controllers',
        ],
    ],
```

Usage
-----

to access to frontend:
**http://example.com/announcement/anitems**
**http://example.com/announcement/anitems/create**

to access to backend:
**http://backend.example.com/announcement/anitems**
**http://backend.example.com/announcement/ancats**
**http://backend.example.com/announcement/anregions**

Also you can use a widget where you need as follows:
```
   <?= \vov\announcement\widgets\Announcement::widget([
       'perPage' => 5,
   ]); ?>
```

Generate module translations
-----
```
	$ yii message vendor/vov/yii2-announcement/messages/config.php
```

