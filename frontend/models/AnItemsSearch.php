<?php

namespace vov\announcement\frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vov\announcement\backend\models\AnCats;
use vov\announcement\common\models\AnItems;

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
    public function search($params, $perPage)
    {
        $query = AnItems::find()->where(['status' => 1]);
        $query->joinwith(['cat', 'region']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $perPage,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // якщо вибрана категорія є головним батьком (root) - вибираємо всіх його дітей
        if($this->category != null){
            $cats = AnCats::find()->where(['id' => $this->category])->all();
            foreach($cats as $cat){
                $children[] = $cat->children()->all();
            }
            foreach($children as $childs){
                foreach($childs as $child){
                    $this->category[] = $child->id;
                }
            }
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'an_cats.id' => $this->category,
            'an_regions.id' => $this->region,
            'an_cats.local' => Yii::$app->language,
            'an_items.local' => Yii::$app->language,
        ]);


        $query->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'site', $this->site]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $perPage,
            ],
        ]);

        return $dataProvider;
    }
}
