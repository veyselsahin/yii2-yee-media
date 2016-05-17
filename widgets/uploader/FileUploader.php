<?php

namespace yeesoft\media\widgets\uploader;

use dosamigos\fileupload\FileUploadUI;
use yeesoft\media\models\Media;
use yii\helpers\Html;

/**
 * Widget to render file uploader.
 *
 * Basic usage:
 * ~~~
 * echo FileUploader::widget([
 *   'ownerModel' => $model,
 * ])
 * ~~~
 */
class FileUploader extends FileUploadUI
{
    /**
     * Url to fronend controller that extends UploaderController
     *
     * @var string
     */
    public $baseUrl = '/uploader';

    /**
     * Instance of uploaded file model
     *
     * @var \yeesoft\db\ActiveRecord
     */
    public $model;

    /**
     * Istance of owner model. All uploaded
     * images will be attached to this model.
     *
     * @var \yeesoft\db\ActiveRecord
     */
    public $ownerModel;

    /**
     * Attribute for internal use.
     *
     * @var string
     */
    public $attribute = 'file';

    /**
     * CSS selector that indicates container that
     * contains hidden inputs for storing data
     * to owner model.
     *
     * @var string
     */
    public $inputContainer;

    /**
     * Attribute name of owner form for storing data.
     *
     * @var string
     */
    public $inputName;

    /**
     * Form view template.
     *
     * @var string
     */
    public $formView = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/form';

    /**
     * Download files view template.
     *
     * @var string
     */
    public $uploadTemplateView = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/upload';

    /**
     * Upload files view template.
     *
     * @var string
     */
    public $downloadTemplateView = '@vendor/yeesoft/yii2-yee-media/widgets/uploader/views/download';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if (!$this->model) {
            $this->model = new Media();
        }

        if ($this->ownerModel && !$this->inputContainer) {
            $this->inputContainer = '#' . Html::getInputId($this->ownerModel, $this->ownerModel->getUploadAttribute());
        }

        if ($this->ownerModel && !$this->inputName) {
            $this->inputName = Html::getInputName($this->ownerModel, $this->ownerModel->getUploadAttribute());
        }

        $this->clientOptions = [
            'autoUpload' => true,
            'previewMaxWidth' => 120,
            'previewMaxHeight' => 120,
            'previewCrop' => true,
        ];

        $this->gallery = false;

        if ($this->baseUrl) {
            $this->url = $this->baseUrl . '/upload';
        }

        parent::init();
    }
}