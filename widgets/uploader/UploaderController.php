<?php

namespace yeesoft\media\widgets\uploader;

use yeesoft\media\assets\MediaAsset;
use yeesoft\media\models\Media;
use yeesoft\media\models\MediaUpload;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;

abstract class UploaderController extends \yii\web\Controller
{

    public $modelClass = 'yeesoft\media\models\Media';
    public $enableCsrfValidation = false;

    /**
     * Upload routes
     *
     * Example:
     * ~~~
     * [
     *    // base absolute path to web directory
     *    'baseUrl' => '',
     *    // base web directory url
     *    'basePath' => '@frontend/web', //@webroot
     *    // path for uploaded files in web directory
     *    'uploadPath' => 'uploads',
     * ]
     * ~~~
     *
     * @var array
     */
    public $routes;

    /**
     * @var array thumbnails info
     */
    public $thumbs;

    /**
     * Allowed for uploading file types. All file types will be allowed
     * if this parameter is not set or is empty.
     *
     * @var array
     */
    public $allowedFileTypes = [];

    /**
     * If true files will be renamed to random name
     *
     * @var boolean
     */
    public $rename = true;

    /**
     * Id of default album ID for uploaded file by users.
     * You can set `uploaderAlbumId` value in params.php
     *
     * @var int
     */
    public $defaultAlbumId;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'upload' => ['post'],
                    'load' => ['post'],
                ],
            ],
        ]);
    }

    public function init()
    {
        parent::init();

        // Init routes
        $routesLocal = (is_array($this->routes)) ? $this->routes : [];
        $routesParams = (isset(Yii::$app->params['mediaRoutes']) && is_array(Yii::$app->params['mediaRoutes'])) ? Yii::$app->params['mediaRoutes'] : [];
        $this->routes = ArrayHelper::merge($routesParams, $routesLocal);

        if (!isset($this->routes['baseUrl'])) {
            $this->routes['baseUrl'] = '';
        }

        if (!isset($this->routes['basePath'])) {
            $this->routes['basePath'] = '@frontend/web';
        }

        if (!isset($this->routes['uploadPath'])) {
            $this->routes['uploadPath'] = 'uploads';
        }

        $thumbsLocal = (is_array($this->thumbs)) ? $this->thumbs : [];
        $thumbsParams = (isset(Yii::$app->params['mediaThumbs']) && is_array(Yii::$app->params['mediaThumbs'])) ? Yii::$app->params['mediaThumbs'] : [];
        $this->thumbs = ArrayHelper::merge($thumbsParams, $thumbsLocal);

        //Init thumbs sizes
        if (empty($this->thumbs)) {
            $this->thumbs = [
                'small' => [
                    'name' => 'Small size',
                    'size' => [120, 80],
                ],
                'medium' => [
                    'name' => 'Medium size',
                    'size' => [400, 300],
                ],
                'large' => [
                    'name' => 'Large size',
                    'size' => [800, 600],
                ],
            ];
        }

        //Set up defaukt album ID
        if (isset(Yii::$app->params['uploaderAlbumId'])) {
            $this->defaultAlbumId = (int)Yii::$app->params['uploaderAlbumId'];
        }
    }

    /**
     * Provides upload file
     * @return mixed
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            $response['files'][] = [
                'error' => 'Please, authorise to upload files.',
            ];
            return $response;
        }

        $model = new Media();

        try {
            $model->saveUploadedFile($this->routes, $this->rename, $this->allowedFileTypes);
        } catch (\Exception $exc) {
            $response['files'][] = [
                'error' => $exc->getMessage()
            ];
            return $response;
        }

        $bundle = MediaAsset::register($this->view);

        if ($model->isImage()) {
            $model->createThumbs($this->routes, $this->thumbs);
        }

        if ($this->defaultAlbumId) {
            $model->album_id = $this->defaultAlbumId;
            $model->save();
        }

        $response['files'][] = [
            'url' => $model->url,
            'thumbnailUrl' => $model->getDefaultThumbUrl($bundle->baseUrl),
            'id' => $model->primaryKey,
            'name' => $model->filename,
            'type' => $model->type,
            'size' => $model->file->size,
            'deleteUrl' => Url::to(['delete', 'id' => $model->id]),
            'deleteType' => 'POST',
        ];

        return $response;
    }

    /**
     * Delete model with medias
     * @param $id
     * @return array
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            return ['error' => 'Please, authorise to delete files.'];
        }

        $tableName = Media::tableName();

        /**
         * @var yeesoft\media\models\Media
         */
        $model = Media::findOne([
            "{$tableName}.id" => $id,
            "{$tableName}.created_by" => Yii::$app->user->identity->id,
        ]);

        if (!$model) {
            return ['error' => Yii::t('yii', 'You are not allowed to perform this action.')];
        }

        if ($model->isImage()) {
            $model->deleteThumbs($this->routes);
        }

        $model->deleteFile($this->routes);
        $model->delete();

        return ['success' => 'true'];
    }

    public function actionLoad()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            $response['files'][] = [
                'error' => 'Please, authorise to upload files.',
            ];
            return $response;
        }

        $bundle = MediaAsset::register($this->view);

        $ownerClass = urldecode(Yii::$app->getRequest()->post('owner_class'));
        $ownerId = Yii::$app->getRequest()->post('owner_id');

        $uploads = MediaUpload::getAll($ownerClass, $ownerId);

        foreach ($uploads as $upload) {
            $model = $upload->media;
            $response['files'][] = [
                'url' => $model->url,
                'thumbnailUrl' => $model->getDefaultThumbUrl($bundle->baseUrl),
                'id' => $model->primaryKey,
                'name' => $model->filename,
                'type' => $model->type,
                'size' => $model->size,
                'deleteUrl' => Url::to(['delete', 'id' => $model->id]),
                'deleteType' => 'POST',
            ];
        }

        return $response;
    }

}
