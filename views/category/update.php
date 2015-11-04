<?php

use yeesoft\media\MediaModule;
use yeesoft\Yee;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Category */

$this->title = MediaModule::t('media', 'Update Category');
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('media', 'Media'), 'url' => ['/media']];
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('media', 'Albums'), 'url' => ['/media/album/index']];
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('media', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yee::t('yee', 'Update');
?>
<div class="media-category-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>