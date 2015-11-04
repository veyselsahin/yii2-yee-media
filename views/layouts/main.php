<?php

use yeesoft\assets\LanguagePillsAsset;
use yeesoft\media\assets\MediaAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */

LanguagePillsAsset::register($this);
MediaAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css">
            body {
                overflow-x: hidden;
            }

            .col-sm-12 .panel {
                margin-bottom: 10px;
            }

            .col-sm-12 .panel .panel-body {
                height: 60px !important;
            }

            .panel {
                margin-bottom: 0px;
            }

            .row {
                margin-left: -5px;
                margin-right: -5px;
            }

            .col-sm-8, .col-sm-4, .col-sm-12 {
                padding-left: 5px;
                padding-right: 5px;
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();