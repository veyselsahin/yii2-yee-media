<?php

use yeesoft\helpers\Html;
use yeesoft\media\assets\MediaAsset;
use yeesoft\media\MediaModule;
use yeesoft\models\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Media */
/* @var $form yii\widgets\ActiveForm */

$bundle = MediaAsset::register($this);
?>

<?= Html::img($model->getDefaultThumbUrl($bundle->baseUrl)) ?>

    <ul class="detail">
        <li><?= $model->type ?></li>
        <li><?= Yii::$app->formatter->asDatetime($model->getLastChanges()) ?></li>
        <?php if ($model->isImage()) : ?>
            <li><?= $model->getOriginalImageSize($this->context->module->routes) ?></li>
        <?php endif; ?>
        <li><?= $model->getFileSize() ?></li>
    </ul>

    <div class="filename"><?= $model->filename ?></div>

<?php
$form = ActiveForm::begin([
    'action' => ['/media/manage/update', 'id' => $model->id],
    'options' => ['id' => 'control-form'],
]);
?>
<?php if ($model->isImage()) : ?>
    <?= $form->field($model, 'alt')->textInput(['class' => 'form-control input-sm']); ?>
<?php endif; ?>

<?= $form->field($model, 'description')->textarea(['class' => 'form-control input-sm']); ?>

<?php if ($model->isImage()) : ?>
    <div class="form-group<?= $strictThumb ? ' hidden' : '' ?>">
        <?= Html::label(MediaModule::t('main', 'Select image size'), 'image', ['class' => 'control-label']) ?>

        <?= Html::dropDownList('url', $model->getThumbUrl($strictThumb),
            $model->getImagesList($this->context->module),
            ['class' => 'form-control input-sm']
        ) ?>
        <div class="help-block"></div>
    </div>
<?php else : ?>
    <?= Html::hiddenInput('url', $model->url) ?>
<?php endif; ?>

<?= Html::hiddenInput('id', $model->id) ?>

<?php if (User::hasPermission('editMedia')): ?>
    <?= Html::submitButton(MediaModule::t('main', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php endif; ?>

<?= Html::button(MediaModule::t('main', 'Insert'), ['id' => 'insert-btn', 'class' => 'btn btn-primary']) ?>

<?= Html::a(MediaModule::t('main', 'Delete'), ['/media/manage/delete', 'id' => $model->id], [
    'class' => 'btn btn-default',
    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
    'data-id' => $model->id,
    'role' => 'delete',
]) ?>

<?php if ($message = Yii::$app->session->getFlash('mediafileUpdateResult')) : ?>
    <div class="text-success"><?= $message ?></div>
<?php endif; ?>
<?php ActiveForm::end(); ?>