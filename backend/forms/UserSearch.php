<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\User;

/**
 * UserSearch represents the model behind the search form of `core\entities\User`.
 */
class UserSearch extends Model
{

    public $id;
    public $status;
    public $created_at;
    public $updated_at;
    public $username;
    public $email;

    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email'], 'safe'],
        ];
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
