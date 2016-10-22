<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * CollocationSearch represents the model behind the search form about `app\models\Collocation`.
 */
class CollocationSearch extends Collocation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'wordId', 'colWordId', 'CollocationPattern'], 'integer'],
            [['RowVersion'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return parent::scenarios();
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
        $query = Collocation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'wordId' => $this->wordId,
            'colWordId' => $this->colWordId,
            'CollocationPattern' => $this->CollocationPattern,
            /*'RowVersion' => $this->RowVersion,*/
        ]);

	    /*$query->andFilterWhere(['like', 'wordId', $this->wordId])
		    ->andFilterWhere(['like', 'colWordId', $this->colWordId])
		    ->andFilterWhere(['like', 'CollocationPattern', $this->CollocationPattern]);*/

        return $dataProvider;
    }
}
