announcement
============
write and read announcement in a frontend and backend

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

add

```
"vov/yii2-announcement": "*"
```

to the require section of your `composer.json` file.

update your database:
```
yii migrate/up --migrationPath=@vendor/vov/yii2-announcement/migrations
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \vov\announcement\AutoloadExample::widget(); ?>```