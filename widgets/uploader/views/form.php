<?php

/** @var \yeesoft\media\widgets\uploader\FileUploader $this */
use yeesoft\helpers\FA;
use yeesoft\media\assets\UploaderAsset;
use yii\base\Model;
use yii\helpers\Html;

$context = $this->context;
$ownerModel = urlencode($context->ownerModel->className());
$formSelector = '#' . $context->options['id'];

$jsBind = <<<JS
    $('{$formSelector}')
    .bind('fileuploaddone', function (e, data) {
        if(data.textStatus === 'success'){
            var input = "<input type='hidden' name='{$context->inputName}[]' value='" + data.result.files[0].id + "'>";
            $("{$context->inputContainer}").append(input);
        }
    }).bind('fileuploaddestroy', function (e, data) {
        $("{$context->inputContainer}").find("input[value='" + data.id + "']").remove();
    });
JS;

$this->registerJs($jsBind);

if (!$context->ownerModel->isNewRecord) {
    $ownerId = $context->ownerModel->primaryKey;

    $jsLoad = <<<JS
    var form = $('{$formSelector}');
    $.ajax({
        method: 'post',
        dataType: 'json',
        url: '{$context->baseUrl}/load',
        data: {owner_class: '{$ownerModel}', owner_id: {$ownerId}}
    }).done(function (data) {
        form.fileupload('option', 'done').call(form, $.Event('done'), {result: {files: data.files}});
    });
JS;

    $this->registerJs($jsLoad);
}

UploaderAsset::register($this);
?>

<div class="clearfix quick-upload">
    <?= Html::beginForm($context->url, 'post', $context->options); ?>

    <div role="presentation" class="files pull-left"></div>

    <div class="fileupload-buttonbar pull-left">
        <div class="btn btn-primary fileinput-button">
            <div style="vertical-align: middle;">
                <?= FA::icon(FA::_PLUS) ?>
                <span><?= Yii::t('yee/media', 'Add files') ?></span>
                <?= $context->model instanceof Model && $context->attribute
                !== null ? Html::activeFileInput($context->model, $context->attribute, $context->fieldOptions) : Html::fileInput($context->name, $context->value, $context->fieldOptions);
                ?>
            </div>
        </div>
    </div>

    <?= Html::endForm(); ?>
</div>