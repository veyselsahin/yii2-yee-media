<?php
/**
 * @link http://www.yee-soft.com/
 * @copyright Copyright (c) 2015 Taras Makitra
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace yeesoft\media;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Media Module For Yee CMS
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class MediaModule extends \yii\base\Module
{
    /**
     * Version number of the module.
     */
    const VERSION = '0.1.0';

    public $controllerNamespace = 'yeesoft\media\controllers';


    /**
     * Allowed for uploading file types. All file types will be allowed
     * if this parameter is not set or is empty.
     *
     * @var array
     */
    public $allowedFileTypes;

    /**
     *  Set true if you want to rename files if the name is already in use
     * @var bolean
     */
    public $rename = false;

    /**
     *  Set true to enable autoupload
     * @var bolean
     */
    public $autoUpload = false;

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
     * @var array default thumbnail size, using in media view.
     */
    private static $defaultThumbSize = [128, 128];

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
    }

    /**
     * @return array default thumbnail size. Using in media view.
     */
    public static function getDefaultThumbSize()
    {
        return self::$defaultThumbSize;
    }
}