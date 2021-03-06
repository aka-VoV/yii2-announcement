<?php

namespace vov\announcement\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AnItemsSearch represents the model behind the search form about `vov\announcement\backend\models\AnItems`.
 */
class AnItemsSearch extends AnItems
{

    public $category;
    public $region;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'region_id', 'status'], 'integer'],
            [['created_at', 'local', 'title', 'text', 'person', 'phone', 'email', 'site', 'category', 'region'], 'safe'],
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
    public function search($params)
    {
        $query = AnItems::find();
        $query->joinwith(['cat', 'region']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'an_cats.id', $this->category])
            ->andFilterWhere(['like', 'an_regions.id', $this->region])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'site', $this->site]);

        return $dataProvider;
    }
}
