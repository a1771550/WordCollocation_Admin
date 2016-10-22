<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pos;

/**
 * PosSearch represents the model behind the search form about `app\models\Pos`.
 */
class PosSearch extends Pos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'CanDel'], 'integer'],
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
        $query = Pos::find();

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
	        'Entry'=>$this->Entry,
	        'EntryZht'=>$this->EntryZht,
	        'EntryZhs'=>$this->EntryZhs,
	        'EntryJap'=>$this->EntryJap,
        ]);

        /*$query->andFilterWhere(['like', 'Entry', $this->Entry])
            ->andFilterWhere(['like', 'EntryZht', $this->EntryZht])
            ->andFilterWhere(['like', 'EntryZhs', $this->EntryZhs])
            ->andFilterWhere(['like', 'EntryJap', $this->EntryJap]);*/

        return $dataProvider;
    }
}
