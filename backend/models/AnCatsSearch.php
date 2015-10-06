<?php

namespace vov\announcement\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vov\announcement\backend\models\AnCats;

/**
 * AnCatsSearch represents the model behind the search form about `vov\announcement\backend\models\AnCats`.
 */
class AnCatsSearch extends AnCats
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name', 'local', 'parentCat'], 'safe'],
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
        $query = AnCats::find()
        ->orderBy('tree');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tree' => $this->parentCat,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'depth' => $this->depth,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'local', $this->local]);

        return $dataProvider;
    }
}
