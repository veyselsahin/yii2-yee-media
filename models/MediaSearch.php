<?php

namespace yeesoft\media\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MediaSearch represents the model behind the search form about `yeesoft\media\models\Media`.
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
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Media::find()->joinWith('translations');

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
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['>=', 'created_at', strtotime($this->created_at)])
            ->andFilterWhere(['<=', 'created_at', strtotime($this->created_at . ' 23:59:59')]);

        return $dataProvider;
    }
}