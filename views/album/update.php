<?php

use yeesoft\media\MediaModule;
use yeesoft\Yee;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Album */

$this->title = Yee::t('yee', 'Update {item}', ['item' => MediaModule::t('media', 'Album')]);
$this->params['breadcrumbs'][] = ['label' => MediaModule::t('media', 'Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yee::t('yee', 'Update');
?>
<div class="album-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>