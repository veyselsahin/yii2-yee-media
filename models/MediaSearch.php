<?php

namespace yeesoft\media\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\imagine\Image as Imagine;
use yii\web\UploadedFile;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property integer $album_id
 * @property integer $author_id
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
class MediaSearch extends Media
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'size', 'album_id', 'created_by', 'updated_by'], 'integer'],
            [['filename', 'type', 'created_at', 'updated_at', 'url', 'alt', 'description', 'thumbs', 'title'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = Media::find()->joinWith('translations');;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'album_id' => $this->album_id,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['>=', 'created_at', strtotime($this->created_at)])
            ->andFilterWhere(['<=', 'created_at', strtotime($this->created_at . ' 23:59:59')]);

        return $dataProvider;
    }
}