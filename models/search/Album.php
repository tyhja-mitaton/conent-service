<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;

class Album extends \app\models\album\Album
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration'], 'integer'],
            ['for_registered_users', 'boolean'],
            [['name', 'showcase_id', 'description', 'author_name', 'author_url', 'cover_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = \app\models\album\Album::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*'pagination' => [
                'pageSize' => 4,
            ],*/
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'id' => $this->id,
            'showcase_id' => $this->showcase_id,
            'duration' => $this->duration,
            'cover_link' => $this->cover_link,
            'for_registered_users' => $this->for_registered_users,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'author_name', $this->author_name]);

        return $dataProvider;
    }
}