<?php

use yeesoft\helpers\Html;
use yeesoft\media\assets\MediaAsset;
use yeesoft\media\MediaModule;
use yeesoft\media\models\Album;
use yeesoft\models\User;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Media */
/* @var $form yii\widgets\ActiveForm */

$bundle = MediaAsset::register($this);
$mode = Yii::$app->getRequest()->get('mode', 'normal');

?>

<?php if (Yii::$app->session->hasFlash('mediaUpdateResult')): ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= Yii::$app->session->getFlash('mediaUpdateResult') ?>
    </div>
<?php endif; ?>

<?php if ($mode !== 'modal'): ?>
    <div class="clearfix">
        <?= Html::img($model->getDefaultThumbUrl($bundle->baseUrl)) ?>

        <ul class="detail">
            <li>
                <b>Author:</b> <?= ($model->created_by) ? (($model->author) ? $model->author->username : 'DELETED') : 'GUEST' ?>
            </li>
            <li><b>Type:</b> <?= $model->type ?></li>
            <li><b>Uploaded:</b> <?= date("Y-m-d", $model->created_at) ?></li>
            <li><b>Updated:</b> <?= date("Y-m-d", $model->getLastChanges()) ?></li>
            <?php if ($model->isImage()) : ?>
                <li><b>Dimensions:</b> <?= $model->getOriginalImageSize($this->context->module->routes) ?></li>
            <?php endif; ?>
            <li><b>File Size:</b> <?= $model->getFileSize() ?></li>
        </ul>
    </div>
<?php endif; ?>

<?php
$form = ActiveForm::begin([
    'action' => ['/media/manage/update', 'id' => $model->id],
    'options' => ['id' => 'control-form'],
]);
?>

<?= $form->field($model, 'url')->textInput([
    'class' => 'form-control input-sm',
    'readonly' => 'readonly',
    'value' => Yii::$app->urlManager->hostInfo . $model->url,
]); ?>

<?= $form->field($model, 'title')->textInput(['class' => 'form-control input-sm']); ?>

<?php if ($mode !== 'modal'): ?>
    <?= $form->field($model, 'album_id')->dropDownList(ArrayHelper::merge([NULL => 'Not Selected'], Album::getAlbums(true, true))) ?>
<?php endif; ?>

<?php if ($model->isImage()) : ?>
    <?= $form->field($model, 'alt')->textInput(['class' => 'form-control input-sm']); ?>
<?php endif; ?>

<?= $form->field($model, 'description')->textarea(['class' => 'form-control input-sm']); ?>

<?php if ($model->isImage() && ($mode == 'modal')) : ?>
    <div class="form-group<?= $strictThumb ? ' hidden' : '' ?>">
        <?= Html::label(MediaModule::t('main', 'Select image size'), 'image', ['class' => 'control-label']) ?>
        <?= Html::dropDownList('url', $model->getThumbUrl($strictThumb), $model->getImagesList($this->context->module), ['class' => 'form-control input-sm']) ?>
        <div class="help-block"></div>
    </div>
<?php else : ?>
    <?= Html::hiddenInput('url', $model->url) ?>
<?php endif; ?>

<?= Html::hiddenInput('id', $model->id) ?>

<?php if (User::hasPermission('editMedia')): ?>
    <?= Html::submitButton(MediaModule::t('main', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php endif; ?>

<?php if ($mode == 'modal'): ?>
    <?= Html::button(MediaModule::t('main', 'Insert'), ['id' => 'insert-btn', 'class' => 'btn btn-primary']) ?>
<?php endif; ?>

<?php if ($mode !== 'modal'): ?>
    <?=
    Html::a(MediaModule::t('main', 'Delete'), ['/media/manage/delete', 'id' => $model->id], [
        'class' => 'btn btn-default',
        'data-message' => Yii::t('yii', 'Are you sure you want to delete this item?'),
        'data-id' => $model->id,
        'role' => 'delete',
    ])
    ?>
<?php endif; ?>

<?php ActiveForm::end(); ?>