<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Agencycperson;

/**
 * AgencycpersonSearch represents the model behind the search form about `common\models\Agencycperson`.
 */
class AgencycpersonSearch extends Agencycperson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'companyAgency_id'], 'integer'],
            [['firstName', 'lastName', 'phoneNumber', 'telNumber', 'email'], 'safe'],
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
        $query = Agencycperson::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'companyAgency_id' => $this->companyAgency_id,
        ]);

        $query->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'telNumber', $this->telNumber])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
