<?php

namespace yeesoft\media;

use Yii;

class MediaModule extends \yii\base\Module
{
    public $controllerNamespace = 'yeesoft\media\controllers';

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
     * @var array upload routes
     */
    public $routes = [
        // base absolute path to web directory
        'baseUrl' => '',
        // base web directory url
        'basePath' => '@webroot',
        // path for uploaded files in web directory
        'uploadPath' => 'uploads',
    ];

    /**
     * @var array thumbnails info
     */
    public $thumbs = [
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

    /**
     * @var array default thumbnail size, using in media view.
     */
    private static $defaultThumbSize = [128, 128];

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['media/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/yeesoft/yii2-yee-media/messages',
            'fileMap' => [
                'modules/media/main' => 'main.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        if (!isset(Yii::$app->i18n->translations['media/*'])) {
            return $message;
        }

        return Yii::t("media/$category", $message, $params, $language);
    }

    /**
     * @return array default thumbnail size. Using in media view.
     */
    public static function getDefaultThumbSize()
    {
        return self::$defaultThumbSize;
    }
}
