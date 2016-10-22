<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Example;

/**
 * ExampleSearch represents the model behind the search form about `app\models\Example`.
 */
class ExampleSearch extends Example
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'CollocationId'], 'integer'],
            [['Entry', 'EntryZht', 'EntryZhs', 'EntryJap', 'Source', 'Remark', 'RowVersion'], 'safe'],
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
        $query = parent::find();

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
            'CollocationId' => $this->CollocationId,
            //'RowVersion' => $this->RowVersion,
        ]);

        $query->andFilterWhere(['like', 'Entry', $this->Entry])
            ->andFilterWhere(['like', 'EntryZht', $this->EntryZht])
            ->andFilterWhere(['like', 'EntryZhs', $this->EntryZhs])
            ->andFilterWhere(['like', 'EntryJap', $this->EntryJap])
            ->andFilterWhere(['like', 'Source', $this->Source])
            ->andFilterWhere(['like', 'Remark', $this->Remark]);

        return $dataProvider;
    }
}
