<?php

use yeesoft\media\assets\ModalAsset;
use yeesoft\media\MediaModule;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = MediaModule::t('main', 'Media Library');
$this->params['breadcrumbs'][] = $this->title;

ModalAsset::register($this);
?>

<div class="media-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <iframe src="<?= Url::to(['manage/index']) ?>" id="post-original_thumbnail-frame" scrolling="no" frameborder="0"
            role="media-frame"></iframe>

</div>

