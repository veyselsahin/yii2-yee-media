<?php

use yeesoft\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="media-category-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'media-category-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">

                        <?= $form->field($model, 'visible')->checkbox() ?>

                        <div class="form-group">
                            <?php if ($model->isNewRecord): ?>
                                <?= Html::submitButton('<span class="glyphicon glyphicon-plus-sign"></span> Create', ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cancel',
                                    ['/media/category/index'],
                                    ['class' => 'btn btn-default'])
                                ?>
                            <?php else: ?>
                                <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Save', ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Delete',
                                    ['/media/category/delete', 'id' => $model->id],
                                    [
                                        'class' => 'btn btn-default',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ])
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>