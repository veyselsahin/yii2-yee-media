<?php

/** @var \yeesoft\media\widgets\uploader\FileUploader $this */
use yii\helpers\Html;
use yeesoft\media\assets\UploaderAsset;
use yeesoft\helpers\FA;

$context = $this->context;

UploaderAsset::register($this)
?>

<div class="clearfix quick-upload">
    <?= Html::beginForm($context->url, 'post', $context->options); ?>

    <div role="presentation" class="files pull-left"></div>

    <div class="fileupload-buttonbar pull-left">
        <div class="btn btn-primary fileinput-button">
            <div style="vertical-align: middle;">
            <?= FA::icon(FA::_PLUS) ?>
            <span><?= Yii::t('yee/media', 'Add files') ?>...</span>
            <?= $context->model instanceof \yii\base\Model && $context->attribute
            !== null ? Html::activeFileInput($context->model, $context->attribute, $context->fieldOptions) : Html::fileInput($context->name, $context->value, $context->fieldOptions); ?>
            </div>
        </div>
    </div>

<?= Html::endForm(); ?>
</div>