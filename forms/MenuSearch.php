<?php

<<<<<<< HEAD
namespace abdualiym\cms\entities;
=======
namespace abdualiym\cms\models;
>>>>>>> 8b48ef3ca164c7e9625a53ec14596f9d17e4ff8e

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
<<<<<<< HEAD
use abdualiym\cms\entities\Menu;
=======
use abdualiym\cms\models\Menu;
>>>>>>> 8b48ef3ca164c7e9625a53ec14596f9d17e4ff8e

/**
 * MenuSearch represents the model behind the search form of `backend\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'type', 'sort', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'type_helper'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Menu::find();

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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'sort' => $this->sort,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type_helper', $this->type_helper]);

        return $dataProvider;
    }
}
