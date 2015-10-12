<?php

namespace yeesoft\media\models;

use yii\behaviors\SluggableBehavior;
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
 */
class Album extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media_album';
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
            [['category_id', 'title'], 'required'],
            [['category_id', 'visible'], 'integer'],
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'slug' => 'Slug',
            'title' => 'Title',
            'visible' => 'Visible',
            'description' => 'Description',
        ];
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
}