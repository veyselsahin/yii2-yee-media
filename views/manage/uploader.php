<?php

use dosamigos\fileupload\FileUploadUI;
use yeesoft\media\MediaModule;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\media\models\Media */
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div id="uploadmanager">
            <p>
                <?= Html::a('← ' . MediaModule::t('main', 'Back to file manager'), ['manage/index']) ?>
            </p>

            <?= FileUploadUI::widget([
                'model' => $model,
                'attribute' => 'file',
                'formView' => '@vendor/yeesoft/yii2-yee-media/views/upload-widget/form',
                'uploadTemplateView' => '@vendor/yeesoft/yii2-yee-media/views/upload-widget/upload',
                'downloadTemplateView' => '@vendor/yeesoft/yii2-yee-media/views/upload-widget/download',
                'clientOptions' => [
                    'autoUpload' => Yii::$app->getModule('media')->autoUpload,
                ],
                'url' => ['upload'],
                'gallery' => false,
            ]) ?>

        </div>
    </div>
</div>