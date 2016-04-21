<?php
/**
 * @link http://www.yee-soft.com/
 * @copyright Copyright (c) 2015 Taras Makitra
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace yeesoft\media;

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
    const VERSION = '0.1-a';

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

    /**
     * @return array default thumbnail size. Using in media view.
     */
    public static function getDefaultThumbSize()
    {
        return self::$defaultThumbSize;
    }
}
