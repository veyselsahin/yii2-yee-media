<?php

namespace yeesoft\media\models;

use omgdef\multilingual\MultilingualQuery;
use yeesoft\behaviors\MultilingualBehavior;
use yeesoft\media\MediaModule;
use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yeesoft\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\imagine\Image as Imagine;
use yii\web\UploadedFile;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property integer $album_id
 * @property string $filename
 * @property string $type
 * @property string $url
 * @property string $title
 * @property string $alt
 * @property integer $size
 * @property string $description
 * @property string $thumbs
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Media extends ActiveRecord implements OwnerAccess
{
    public $file;
    public static $imageFileTypes = ['image/gif', 'image/jpeg', 'image/png'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'type'], 'required'],
            [['alt', 'description', 'thumbs'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'size', 'album_id'], 'integer'],
            [['filename', 'type', 'title'], 'string', 'max' => 255],
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'album_id' => Yii::t('yee/media', 'Album'),
            'filename' => Yii::t('yee/media', 'Filename'),
            'type' => Yii::t('yee', 'Type'),
            'url' => Yii::t('yee', 'URL'),
            'title' => Yii::t('yee', 'Title'),
            'alt' => Yii::t('yee/media', 'Alt Text'),
            'size' => Yii::t('yee', 'Size'),
            'description' => Yii::t('yee', 'Description'),
            'thumbs' => Yii::t('yee/media', 'Thumbnails'),
            'created_at' => Yii::t('yee', 'Uploaded'),
            'updated_at' => Yii::t('yee', 'Updated'),
            'created_by' => Yii::t('yee/media', 'Uploaded By'),
            'updated_by' => Yii::t('yee/media', 'Updated By'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'media_id',
                'tableName' => "{{%media_lang}}",
                'attributes' => [
                    'title', 'description', 'alt',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return static|null ActiveRecord instance matching the condition, or `null` if nothing matches.
     */
    public static function findOne($condition)
    {
        return static::findByCondition($condition)->joinWith('translations')->one();
    }

    /**
     * @inheritdoc
     * @return static[] an array of ActiveRecord instances, or an empty array if nothing matches.
     */
    public static function findAll($condition)
    {
        return static::findByCondition($condition)->joinWith('translations')->all();
    }

    /**
     * Return created_by user instance
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Save just uploaded file
     *
     * @param array $routes routes from module settings
     * @return bool
     */
    public function saveUploadedFile(array $routes, $rename = false, $allowedFileTypes = null)
    {
        $year = date('Y', time());
        $month = date('m', time());
        $structure = "{$routes['baseUrl']}/{$routes['uploadPath']}/$year/$month";
        $basePath = Yii::getAlias($routes['basePath']);
        $absolutePath = "$basePath/$structure";

        // create actual directory structure "yyyy/mm"
        if (!file_exists($absolutePath)) {
            mkdir($absolutePath, 0777, true);
        }

        // get file instance
        $this->file = UploadedFile::getInstance($this, 'file');

        if ($allowedFileTypes === null) {
            $allowedFileTypes = Yii::$app->getModule('media')->allowedFileTypes;
        }

        if (!empty($allowedFileTypes) && is_array($allowedFileTypes) && !in_array($this->file->type, $allowedFileTypes)) {
            throw new \Exception(Yii::t('yee/media', 'Sorry, [{filetype}] file type is not permitted!', ['filetype' => $this->file->type]));
        }

        //if a file with the same name already exist append a number
        $counter = 0;
        do {
            if ($counter == 0)
                $filename = Inflector::slug($this->file->baseName) . '.' . $this->file->extension;
            else {
                //if we don't want to rename we finish the call here
                if ($rename == false) return false;
                $filename = Inflector::slug($this->file->baseName) . $counter . '.' . $this->file->extension;
            }
            $url = "$structure/$filename";
            $counter++;
        } while (self::findByUrl($url)); // checks for existing url in db
        // save original uploaded file
        $this->file->saveAs("$absolutePath/$filename");
        $this->filename = $filename;
        $this->title = $filename;
        $this->alt = $filename;
        $this->type = $this->file->type;
        $this->size = $this->file->size;
        $this->url = $url;

        return $this->save();
    }

    /**
     * Create thumbs for this image
     *
     * @param array $routes see routes in module config
     * @param array $presets thumbs presets. See in module config
     * @return bool
     */
    public function createThumbs(array $routes, array $presets)
    {
        $thumbs = [];
        $basePath = $basePath = Yii::getAlias($routes['basePath']);
        $originalFile = pathinfo($this->url);
        $dirname = $originalFile['dirname'];
        $filename = $originalFile['filename'];
        $extension = $originalFile['extension'];

        Imagine::$driver = [Imagine::DRIVER_GD2, Imagine::DRIVER_GMAGICK, Imagine::DRIVER_IMAGICK];

        foreach ($presets as $alias => $preset) {
            $width = $preset['size'][0];
            $height = $preset['size'][1];

            $thumbUrl = "$dirname/$filename-{$width}x{$height}.$extension";

            Imagine::thumbnail("$basePath/{$this->url}", $width, $height)->save("$basePath/$thumbUrl");

            $thumbs[$alias] = $thumbUrl;
        }

        $this->thumbs = serialize($thumbs);
        $this->detachBehavior('timestamp');

        // create default thumbnail
        $this->createDefaultThumb($routes);

        return $this->save();
    }

    /**
     * Create default thumbnail
     *
     * @param array $routes see routes in module config
     */
    public function createDefaultThumb(array $routes)
    {
        $originalFile = pathinfo($this->url);
        $dirname = $originalFile['dirname'];
        $filename = $originalFile['filename'];
        $extension = $originalFile['extension'];

        Imagine::$driver = [Imagine::DRIVER_GD2, Imagine::DRIVER_GMAGICK, Imagine::DRIVER_IMAGICK];

        $size = MediaModule::getDefaultThumbSize();
        $width = $size[0];
        $height = $size[1];
        $thumbUrl = "$dirname/$filename-{$width}x{$height}.$extension";
        $basePath = Yii::getAlias($routes['basePath']);
        Imagine::thumbnail("$basePath/{$this->url}", $width, $height)->save("$basePath/$thumbUrl");
    }


    /**
     * @return bool if type of this media file is image, return true;
     */
    public function isImage()
    {
        return in_array($this->type, self::$imageFileTypes);
    }

    /**
     * @param $baseUrl
     * @return string default thumbnail for image
     */
    public function getDefaultThumbUrl($baseUrl = '')
    {
        if ($this->isImage()) {
            $size = MediaModule::getDefaultThumbSize();
            $originalFile = pathinfo($this->url);
            $dirname = $originalFile['dirname'];
            $filename = $originalFile['filename'];
            $extension = $originalFile['extension'];
            $width = $size[0];
            $height = $size[1];

            return "$dirname/$filename-{$width}x{$height}.$extension";
        }

        return "$baseUrl/images/picture.png";
    }

    /**
     * @return array thumbnails
     */
    public function getThumbs()
    {
        return unserialize($this->thumbs);
    }

    /**
     * @param string $alias thumb alias
     * @return string thumb url
     */
    public function getThumbUrl($alias)
    {
        $thumbs = $this->getThumbs();

        if ($alias === 'original') {
            return $this->url;
        }

        return !empty($thumbs[$alias]) ? $thumbs[$alias] : '';
    }

    /**
     * Thumbnail image html tag
     *
     * @param string $alias thumbnail alias
     * @param array $options html options
     * @return string Html image tag
     */
    public function getThumbImage($alias, $options = [])
    {
        $url = $this->getThumbUrl($alias);

        if (empty($url)) {
            return '';
        }

        if (empty($options['alt'])) {
            $options['alt'] = $this->alt;
        }

        return Html::img($url, $options);
    }

    /**
     * @param MediaModule $module
     * @return array images list
     */
    public function getImagesList(MediaModule $module)
    {
        $thumbs = $this->getThumbs();
        $list = [];

        foreach ($thumbs as $alias => $url) {
            $preset = $module->thumbs[$alias];
            $list[$url] = Yii::t('yee/media', $preset['name']) . ' ' . $preset['size'][0] . ' × ' . $preset['size'][1];
        }

        $originalImageSize = $this->getOriginalImageSize($module->routes);
        $list[$this->url] = Yii::t('yee/media', 'Original') . ' ' . $originalImageSize;

        return $list;
    }

    /**
     * Delete thumbnails for current image
     * @param array $routes see routes in module config
     */
    public function deleteThumbs(array $routes)
    {
        $basePath = Yii::getAlias($routes['basePath']);

        foreach ($this->getThumbs() as $thumbUrl) {
            unlink("$basePath/$thumbUrl");
        }

        unlink("$basePath/{$this->getDefaultThumbUrl()}");
    }

    /**
     * Delete file
     * @param array $routes see routes in module config
     * @return bool
     */
    public function deleteFile(array $routes)
    {
        $basePath = Yii::getAlias($routes['basePath']);
        return unlink("$basePath/{$this->url}");
    }

    /**
     * @return int last changes timestamp
     */
    public function getLastChanges()
    {
        return !empty($this->updated_at) ? $this->updated_at : $this->created_at;
    }

    /**
     * This method wrap getimagesize() function
     * @param array $routes see routes in module config
     * @param string $delimiter delimiter between width and height
     * @return string image size like '1366x768'
     */
    public function getOriginalImageSize(array $routes, $delimiter = ' × ')
    {
        $imageSizes = $this->getOriginalImageSizes($routes);
        return "$imageSizes[0]$delimiter$imageSizes[1]";
    }

    /**
     * This method wrap getimagesize() function
     * @param array $routes see routes in module config
     * @return array
     */
    public function getOriginalImageSizes(array $routes)
    {
        $basePath = Yii::getAlias($routes['basePath']);
        return getimagesize("$basePath/{$this->url}");
    }

    /**
     * @return string file size
     */
    public function getFileSize()
    {
        Yii::$app->formatter->sizeFormatBase = 1024;
        return Yii::$app->formatter->asShortSize($this->size, 1);
    }

    /**
     * Find model by url
     *
     * @param $url
     * @return static
     */
    public static function findByUrl($url)
    {
        return self::findOne(['url' => $url]);
    }

    /**
     * Search models by file types
     * @param array $types file types
     * @return array|\yeesoft\db\ActiveRecord[]
     */
    public static function findByTypes(array $types)
    {
        return self::find()->filterWhere(['in', 'type', $types])->all();
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullMediaAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }

    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }
}