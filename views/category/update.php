<?php

use yeesoft\Yee;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Category */

$this->title = 'Update Category: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Media'), 'url' => ['/media']];
$this->params['breadcrumbs'][] = ['label' => Yee::t('back', 'Albums'), 'url' => ['/media/album/index']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="media-category-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>