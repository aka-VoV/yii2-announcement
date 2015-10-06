<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 24.02.2015
 * Time: 17:39
 */
use yii\widgets\ListView;
?>


    <li class="list-group-item">

<!--        <div class="col-md-8">-->
            <h4 class="list-group-item-heading"><?=$model->title;?></h4>
        <a class="label label-default" href="?<?= urlencode('AnItemsSearch[category][]')?>=<?=$model->cat->id;?>"><?=$model->cat->name;?></a>
        <div class="label label-info"><?= $model->created_at;?></div>
<!--        </div>-->

        <div class="list-group-item-text">

            <div class="panel panel-default">
                <div class="panel-body">
                    <?=$model->text;?>
                </div>
                <div class="panel-footer">
                    <ul class="nav">
                        <li><div class="col-md-2"><span class="label label-default"><?= \vov\announcement\Module::t('frontend', 'Region');?>Регіон:</span></div> <span class="col-md-10"><?=$model->region->name;?></span></li>
                        <li><div class="col-md-2"><span class="label label-default"><?= \vov\announcement\Module::t('frontend', 'Person');?>Контактна особа:</span></div> <span class="col-md-10"><?=$model->person;?></span></li>
                        <li><div class="col-md-2"><span class="label label-default"><?= \vov\announcement\Module::t('frontend', 'Phone');?>Телефон:</span></div> <span class="col-md-10"><?=$model->phone;?></span></li>
                        <li><div class="col-md-2"><span class="label label-default"><?= \vov\announcement\Module::t('frontend', 'Email');?>Email:</span></div> <span class="col-md-10"><?=$model->email;?></span></li>
                        <li><div class="col-md-2"><span class="label label-default"><?= \vov\announcement\Module::t('frontend', 'Site');?>Сайт:</span></div> <span class="col-md-10"><?=$model->site;?></span></li>
                    </ul>
                </div>
            </div>

        </div>
    </li>


