<?php

namespace yeesoft\media\widgets\uploader;

use yeesoft\media\models\Media;
use yeesoft\media\models\MediaUpload;
use Yii;
use yii\base\Behavior;
use yii\base\UnknownPropertyException;
use yeesoft\db\ActiveRecord;
use yii\validators\Validator;

/**
 * Class UploaderBehavior
 * @package yeesoft\media
 *
 * @mixin ActiveRecord
 * @property ActiveRecord $owner
 */
class UploaderBehavior extends Behavior
{

    /**
     * Attribute name of uploaded files IDs input.
     *
     * @var string
     */
    public $attribute = 'uploads';
    protected $uploads;
    protected $newUploads;
    protected $ownerClassName;
    protected $isAttributesLoaded;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_INIT => 'uploadInit',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attach($owner)
    {
        /** @var ActiveRecord $owner */
        parent::attach($owner);
        /** @var ActiveRecord $className */
        $this->ownerClassName = get_class($this->owner);
        $this->uploads = [];
        $this->newUploads = [];
    }

    public function uploadInit()
    {
        $validators = $this->owner->getValidators();
        $validators[] = Validator::createValidator('safe', $this->owner, [$this->attribute], []);
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        if (!$this->owner->isNewRecord) {
            $uploads = MediaUpload::find()
                ->select('media_id')
                ->where(['owner_class' => $this->ownerClassName])
                ->where(['owner_id' => $this->owner->primaryKey])
                ->asArray()
                ->all();

            foreach ($uploads as $upload) {
                $this->uploads[] = $upload['media_id'];
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function canGetProperty($name, $checkVars = true)
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name) || $this->isUploadAttribute($name);
    }

    /**
     * @inheritdoc
     */
    public function canSetProperty($name, $checkVars = true)
    {
        return $this->isUploadAttribute($name);
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (UnknownPropertyException $e) {
            if ($this->isUploadAttribute($name)) {
                return $this->getUploadValue();
            } else {
                throw $e;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        try {
            parent::__set($name, $value);
        } catch (UnknownPropertyException $e) {
            if ($this->isUploadAttribute($name)) {
                $this->setUploadValue($value);
            } else {
                throw $e;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function __isset($name)
    {
        if (!parent::__isset($name)) {
            return $this->isUploadAttribute($name);
        } else {
            return true;
        }
    }

    /**
     * Whether an attribute exists.
     *
     * @param string $name the name of the attribute
     * @return boolean
     */
    public function isUploadAttribute($name)
    {
        return $name === $this->attribute;
    }

    /**
     * @return array the attribute value
     */
    public function getUploadValue()
    {
        return $this->uploads;
    }

    /**
     * @param array $value the value of the attribute
     */
    public function setUploadValue($value)
    {
        $this->newUploads = [];

        foreach ($value as $media_id) {
            if (ctype_digit($media_id) && !in_array($media_id, $this->newUploads)) {
                $media = Media::findOne([Media::tableName() . '.' . Media::primaryKey()[0] => $media_id]);

                //Disallow to add images uploaded by other users
                if (!$media || $media->created_by !== Yii::$app->user->id) {
                    continue;
                }

                $this->newUploads[] = (int)$media_id;
            }
        }
    }

    public function afterSave()
    {
        MediaUpload::deleteAll([
            'owner_class' => $this->ownerClassName,
            'owner_id' => $this->owner->primaryKey,
        ]);

        foreach ($this->newUploads as $media_id) {
            $mediaUpload = new MediaUpload([
                'media_id' => $media_id,
                'owner_class' => $this->ownerClassName,
                'owner_id' => $this->owner->primaryKey,
            ]);

            $mediaUpload->save();
        }

        $this->uploads = $this->newUploads;
    }

    /**
     * @return string the attribute name
     */
    public function getUploadAttribute()
    {
        return $this->attribute;
    }

    /**
     * @return string the attribute name
     */
    public function getMediaUploads()
    {
        if (!$this->owner->isNewRecord) {
            return MediaUpload::getAll($this->ownerClassName, $this->owner->primaryKey);
        }

        return [];
    }

}
