<?php

use yeesoft\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yeesoft\media\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Media Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-category-view">

    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['/media/category/update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a('Delete', ['/media/category/delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-sm btn-default',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                ?>
                <?= Html::a('Add New', ['/media/category/create'], ['class' => 'btn btn-sm btn-primary pull-right']) ?>
            </p>


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'slug',
                    'title',
                    'visible',
                    'description:ntext',
                ],
            ])
            ?>

        </div>
    </div>

</div>