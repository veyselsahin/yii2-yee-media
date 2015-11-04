<?php

use yeesoft\media\MediaModule;
use yii\bootstrap\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = MediaModule::t('media', 'Image Settings');
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('media', 'Media'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="media-default-settings">
    <h1><?= $this->title ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading"><?= MediaModule::t('media', 'Thumbnails settings') ?></div>
        <div class="panel-body">

            <?php if (Yii::$app->session->getFlash('successResize')) : ?>
                <div class="alert alert-success text-center">
                    <?= MediaModule::t('media', 'Thumbnails sizes has been resized successfully!') ?>
                </div>
            <?php endif; ?>

            <p><?= MediaModule::t('media', 'Current thumbnail sizes') ?>:</p>
            <ul>
                <?php foreach ($this->context->module->thumbs as $preset) : ?>
                    <li><strong><?= MediaModule::t('media', $preset['name']) ?>
                            :</strong> <?= $preset['size'][0] . ' x ' . $preset['size'][1] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><?= MediaModule::t('media', 'If you change the thumbnails sizes, it is strongly recommended resize image thumbnails.') ?></p>
            <?= Html::a(MediaModule::t('media', 'Do resize thumbnails'), ['/media/manage/resize'], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>