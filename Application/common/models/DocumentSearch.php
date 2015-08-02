<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Document;

/**
 * DocumentSearch represents the model behind the search form about `common\models\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type_id', 'priority_id', 'user_id', 'companyAgency_id', 'section_id'], 'integer'],
            [['document_tracking_number', 'documentName', 'documentDesc', 'documentTargetDate', 'documentComment', 'documentImage', 'documentCreate', 'documentUpdate'], 'safe'],
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
        $query = Document::find();

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
            'documentTargetDate' => $this->documentTargetDate,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'priority_id' => $this->priority_id,
            'user_id' => $this->user_id,
            'companyAgency_id' => $this->companyAgency_id,
            'section_id' => $this->section_id,
            'documentCreate' => $this->documentCreate,
            'documentUpdate' => $this->documentUpdate,
        ]);

        $query->andFilterWhere(['like', 'document_tracking_number', $this->document_tracking_number])
            ->andFilterWhere(['like', 'documentName', $this->documentName])
            ->andFilterWhere(['like', 'documentDesc', $this->documentDesc])
            ->andFilterWhere(['like', 'documentComment', $this->documentComment])
            ->andFilterWhere(['like', 'documentImage', $this->documentImage]);

        return $dataProvider;
    }
}
