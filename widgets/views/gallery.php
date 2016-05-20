<?php

use yeesoft\helpers\Html;
use yeesoft\media\assets\MediaAsset;
use yeesoft\media\models\Album;
use yeesoft\models\User;
use yii\grid\GridViewAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yeesoft\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\media\models\Media */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['moduleBundle'] = MediaAsset::register($this);

GridViewAsset::register($this);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div style="padding: 5px; height:50px;" class="panel-body">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'gallery',
                    'action' => Url::to(($mode == 'modal') ? ['/media/manage/index'] : ['/media/default/index']),
                    'method' => 'get',
                    'class' => 'gridview-filter-form',
                    'fieldConfig' => ['template' => "{input}\n{hint}\n{error}"],
                ]);
                ?>
                <table id="gallery-grid-filters" class="table table-striped filters">
                    <thead>
                    <tr id="user-visit-log-grid-filters" class="filters">
                        <td style="width: auto;">
                            <?= $form->field($searchModel, 'album_id')->dropDownList(ArrayHelper::merge(['' => Yii::t('yee/media', 'All Media Items')], Album::getAlbums(true, true)), ['prompt' => '']) ?>
                        </td>
                        <td style="width: auto;">
                            <?= $form->field($searchModel, 'title')->textInput(['placeholder' => $searchModel->attributeLabels()['title']]) ?>
                        </td>
                        <td style="width: auto;">
                            <?= $form->field($searchModel, 'created_at')
                                ->widget(DatePicker::className(), [
                                    'dateFormat' => 'yyyy-MM-dd',
                                    'options' => [
                                        'placeholder' => $searchModel->attributeLabels()['created_at'],
                                        'class' => 'form-control',
                                    ]
                                ]) ?>
                        </td>
                        <?php if (User::hasPermission('uploadMedia')): ?>
                            <td style="width: 1%;">
                                <?= Html::a(Yii::t('yee/media', 'Upload New File'), ($mode == 'modal') ? ['/media/manage/uploader', 'mode' => 'modal'] : ['/media/manage/uploader'], ['class' => 'btn btn-primary pull-right']) ?>
                            </td>
                        <?php endif; ?>
                    </tr>

                    </thead>
                </table>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<div class="row <?= $mode ?>-media-frame">
    <div class="col-sm-8">

        <div class="panel panel-default">
            <div class="panel-body">
                <div id="media" data-frame-mode="<?= $mode ?>" data-url-info="<?= Url::to(['/media/manage/info']) ?>">
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => '<div class="items">{items}</div><div class="text-center">{pager}</div>',
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return Html::a(
                                Html::img($model->getDefaultThumbUrl($this->params['moduleBundle']->baseUrl)), '#mediafile', ['data-key' => $key]
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
            <div class="panel-body media-details">
                <div class="dashboard">
                    <h5><?= Yii::t('yee/media', 'Media Details') ?>:</h5>

                    <div id="fileinfo">
                        <h6><?= Yii::t('yee/media', 'Please, select file to view details.') ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

//Init AJAX filter submit
$options = '{"filterUrl":"' . Url::to(['default/index']) . '","filterSelector":"#gallery-grid-filters input, #gallery-grid-filters select"}';
$this->registerJs("jQuery('#gallery').yiiGridView($options);");

?>
