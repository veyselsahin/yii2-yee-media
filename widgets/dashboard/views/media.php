<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $item yeesoft\media\models\Media */
?>

<div class="pull-<?= $position ?> col-lg-<?= $width ?> widget-height-<?= $height ?>">
    <div class="panel panel-default" style="position:relative; padding-bottom:15px;">
        <div class="panel-heading">Media Activity</div>
        <div class="panel-body">

            <h4 style="font-style: italic;">Recently Uploaded:</h4>

            <div class="clearfix">
                <?php foreach ($recent as $item) : ?>
                    <div class="clearfix" style="border-bottom: 1px solid #eee; margin: 7px; padding: 0 0 5px 5px;">
                        <div class="pull-right">
                            <img src="<?= $item->getThumbUrl('small') ?>"
                                 style="border: 1px solid #888; border-radius:5px;">
                        </div>
                        <div style="margin-right: 130px;" class="text-center">
                            <?= mb_substr($item->alt, 0, 64, "UTF-8") ?>...<br/>
                            <span style="font-size:80%; margin-right: 10px;" class="label label-primary">
                                <?= $item->createdDateTime ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>