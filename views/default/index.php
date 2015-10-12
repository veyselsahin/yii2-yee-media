<?php

use yeesoft\media\assets\ModalAsset;
use yeesoft\media\MediaModule;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = MediaModule::t('main', 'Media Library');
$this->params['breadcrumbs'][] = $this->title;

ModalAsset::register($this);
?>

<div class="media-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Manage Albums', ['/media/album/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?= yeesoft\media\widgets\Gallery::widget() ?>

</div>

