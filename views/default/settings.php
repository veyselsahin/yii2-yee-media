<?php

use yeesoft\media\MediaModule;
use yii\bootstrap\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = MediaModule::t('main', 'Image Settings');
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('main', 'Media Library'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="media-default-settings">
    <h1><?= $this->title ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading"><?= MediaModule::t('main', 'Thumbnails settings') ?></div>
        <div class="panel-body">

            <?php if (Yii::$app->session->getFlash('successResize')) : ?>
                <div class="alert alert-success text-center">
                    <?= MediaModule::t('main', 'Thumbnails sizes has been resized successfully!') ?>
                </div>
            <?php endif; ?>

            <p><?= MediaModule::t('main', 'Now using next thumbnails presets') ?>:</p>
            <ul>
                <?php foreach ($this->context->module->thumbs as $preset) : ?>
                    <li><strong><?= $preset['name'] ?>:</strong> <?= $preset['size'][0] . ' x ' . $preset['size'][1] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><?= MediaModule::t('main', 'If you change the thumbnails sizes, it is strongly recommended to make resize all thumbnails.') ?></p>
            <?= Html::a(MediaModule::t('main', 'Do resize thumbnails'), ['/media/manage/resize'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>