<?php

/* @var $this yii\web\View */
/* @var $item yeesoft\media\models\Media */
?>

    <div class="pull-<?= $position ?> col-lg-<?= $width ?> widget-height-<?= $height ?>">
        <div class="panel panel-default dw-widget">
            <div class="panel-heading"><?= Yii::t('yee/media', 'Media Activity') ?></div>
            <div class="panel-body">

                <?php if (count($recent)): ?>

                    <div class="clearfix">
                        <?php foreach ($recent as $item) : ?>
                            <div class="clearfix dw-media">
                                <div class="pull-left">
                                    <img class="dw-media-image" src="<?= $item->getThumbUrl('small') ?>">
                                </div>
                                <div class="dw-media-info">
                                    <div>
                                        <b><?= Yii::t('yee', 'Title') ?>:</b>
                                        <span><?= ($item->title) ? $item->title : Yii::t('yii', '(not set)') ?></span>
                                    </div>
                                    <div>
                                        <b><?= Yii::t('yee/media', 'File Size') ?>:</b>
                                        <span><?= $item->getFileSize() ?></span>
                                    </div>
                                    <div>
                                        <b><?= Yii::t('yee/media', 'Uploaded By') ?>:</b>
                                        <span><?= $item->author->username ?></span>
                                    </div>
                                    <div>
                                        <b><?= Yii::t('yee', 'Uploaded') ?>:</b>
                                        <span><?= $item->createdDateTime ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <h4><em><?= Yii::t('yee/media', 'No images found.') ?></em></h4>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php
$css = <<<CSS
.dw-widget{
    position:relative;
    padding-bottom:15px;
}
.dw-media {
    border-bottom: 1px solid #eee;
    margin: 7px;
    padding: 0 0 5px 5px;
}
.dw-media-image {
    border: 1px solid #888;
    border-radius:5px;
}
.dw-media-info {
    margin-left: 140px;
}
.dw-quick-links{
    position: absolute;
    bottom:10px;
    left:0;
    right:0;
    text-align: center;
}
CSS;

$this->registerCss($css);
?>