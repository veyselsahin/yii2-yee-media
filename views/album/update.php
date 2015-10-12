<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Album */

$this->title = 'Update Album: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="album-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>