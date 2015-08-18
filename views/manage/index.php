<?php

use yeesoft\helpers\Html;
use yeesoft\media\assets\MediaAsset;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\media\models\Media */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['moduleBundle'] = MediaAsset::register($this);
?>

<div class="row">
    <div class="col-sm-8">

        <div class="panel panel-default">
            <div class="panel-body">
                <div id="media" data-url-info="<?= Url::to(['manage/info']) ?>">
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => '<div class="items">{items}</div><div class="text-center">{pager}</div>',
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return Html::a(
                                Html::img($model->getDefaultThumbUrl($this->params['moduleBundle']->baseUrl)),
                                '#mediafile', ['data-key' => $key]
                            );
                        },
                        'pager' => [
                            'options' => [
                                'class' => 'pagination pagination-sm',
                                'style' => 'display: inline-block;',
                            ],
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">

        <div class="panel panel-default">
            <div class="panel-body">
                <?=
                Html::a('Upload New File', ['manage/uploader'],
                    ['class' => 'btn btn-primary'])
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dashboard">
                    <h5>Media Details:</h5>

                    <div id="fileinfo">
                        <h6>Please, select file to view details.</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


