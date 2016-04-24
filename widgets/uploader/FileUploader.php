<?php

namespace yeesoft\media\widgets\uploader;

use dosamigos\fileupload\FileUploadUI;
use yeesoft\media\models\Media;

/**
 * Widget to render file uploader.
 *
 * Basic usage:
 * ~~~
 * echo FileUploader::widget([
 *   'url' => ['/uploader/upload'],
 * ])
 * ~~~
 */
class FileUploader extends FileUploadUI
{
    public $model;
    public $attribute            = 'file';
    public $formView             = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/form';
    public $uploadTemplateView   = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/upload';
    public $downloadTemplateView = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/download';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if (!$this->model) {
            $this->model = new Media();
        }

        $this->clientOptions = [
            'autoUpload' => true,
            'previewMaxWidth' => 120,
            'previewMaxHeight' => 120,
            'previewCrop' => true,
        ];

        $this->gallery = false;

        parent::init();
    }
}