<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * WordSearch represents the model behind the search form about `app\models\Word`.
 */
class WordSearch extends Word
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'CanDel', 'posId'], 'integer'],
            [['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'RowVersion'], 'safe'],
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
        $query = Word::find();

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
            'RowVersion' => $this->RowVersion,
            'CanDel' => $this->CanDel,
            'posId' => $this->posId,
        ]);

        $query->andFilterWhere(['like', 'Entry', $this->Entry])
            ->andFilterWhere(['like', 'EntryZht', $this->EntryZht])
            ->andFilterWhere(['like', 'EntryZhs', $this->EntryZhs])
            ->andFilterWhere(['like', 'EntryJap', $this->EntryJap]);

        return $dataProvider;
    }
}
