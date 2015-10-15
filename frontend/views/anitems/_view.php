<?php
/**
 * Created by PhpStorm.
 * User: turko_v
 * Date: 24.02.2015
 * Time: 17:39
 */
use yii\widgets\ListView;
?>


    <li class="">

<!--        <div class="col-md-8">-->
            <h2 class="list-group-item-heading"><?=$model->title;?></h2>
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
                        <li><div class="col-md-4"><span class="label label-default"><?= Yii::t('announcement', 'Region');?>Регіон:</span></div> <span class="col-md-8"><?=$model->region->name;?></span></li>
                        <li><div class="col-md-4"><span class="label label-default"><?= Yii::t('announcement', 'Person');?>Контактна особа:</span></div> <span class="col-md-8"><?=$model->person;?></span></li>
                        <li><div class="col-md-4"><span class="label label-default"><?= Yii::t('announcement', 'Phone');?>Телефон:</span></div> <span class="col-md-8"><?=$model->phone;?></span></li>
                        <li><div class="col-md-4"><span class="label label-default"><?= Yii::t('announcement', 'Email');?>Email:</span></div> <span class="col-md-8"><?=$model->email;?></span></li>
                        <li><div class="col-md-4"><span class="label label-default"><?= Yii::t('announcement', 'Site');?>Сайт:</span></div> <span class="col-md-8"><?=$model->site;?></span></li>
                    </ul>
                </div>
            </div>

        </div>
    </li>


