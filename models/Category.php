<?php

namespace yeesoft\media\models;

use omgdef\multilingual\MultilingualQuery;
use yeesoft\behaviors\MultilingualBehavior;
use yeesoft\Yee;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "media_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $visible
 * @property string $description
 */
class Category extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media_category';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->visible = 1;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visible'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['slug', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
            'multilingual' => [
                'class' => MultilingualBehavior::className(),
                'langForeignKey' => 'media_category_id',
                'tableName' => "{{%media_category_lang}}",
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
            'id' => Yee::t('yee', 'ID'),
            'slug' => Yee::t('yee', 'Slug'),
            'title' => Yee::t('yee', 'Title'),
            'visible' => Yee::t('yee', 'Visible'),
            'description' => Yee::t('yee', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['category_id' => 'id']);
    }

    /**
     * Return all categories.
     *
     * @param bool $asArray
     *
     * @return static[]
     */
    public static function getCategories($asArray = false)
    {
        $result = static::find()->all();
        return $asArray ? ArrayHelper::map($result, 'id', 'title') : $result;
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }
}