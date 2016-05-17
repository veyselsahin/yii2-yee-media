<?php

namespace yeesoft\media\models;

use omgdef\multilingual\MultilingualQuery;
use yeesoft\behaviors\MultilingualBehavior;
use yeesoft\models\OwnerAccess;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yeesoft\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "media_album".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $slug
 * @property string $title
 * @property integer $visible
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Album extends ActiveRecord implements OwnerAccess
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%media_album}}';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->className() == Album::className()) {
            $this->visible = 1;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'category_id', 'visible'], 'integer'],
            [['description'], 'string'],
            [['slug', 'title'], 'string', 'max' => 255]
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
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'media_album_id',
                'tableName' => "{{%media_album_lang}}",
                'attributes' => [
                    'title', 'description',
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'category_id' => Yii::t('yee/media', 'Category'),
            'slug' => Yii::t('yee', 'Slug'),
            'title' => Yii::t('yee', 'Title'),
            'visible' => Yii::t('yee', 'Visible'),
            'description' => Yii::t('yee', 'Description'),
            'created_by' => Yii::t('yee', 'Created By'),
            'updated_by' => Yii::t('yee', 'Updated By'),
            'created_at' => Yii::t('yee', 'Created'),
            'updated_at' => Yii::t('yee', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Return all albums.
     *
     * @param bool $asArray return array
     * @param bool $withCategories Two-dimensional array with albums categories
     *
     * @return static[]
     */
    public static function getAlbums($asArray = false, $withCategories = false)
    {
        if (!$withCategories) {
            $result = static::find()->all();
            return $asArray ? ArrayHelper::map($result, 'id', 'title') : $result;
        } else {
            $result = [];
            $categories = Category::find()->all();
            foreach ($categories as $category) {
                $result[$category->title] = ArrayHelper::map($category->albums, 'id', 'title');
            }
            return $result;
        }
    }

    /**
     *
     * @inheritdoc
     */
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
        return 'fullMediaAlbumAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
}