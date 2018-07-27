<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/27/2018
 * Time: 2:00 PM
 */

namespace backend\forms\Blog;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\Blog\Category;

/**
 * Class CategorySearch
 * @package backend\forms\Blog
 */
class CategorySearch extends Model
{
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $slug;
    /**
     * @var
     */
    public $title;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'title'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find()->andWhere(['>', 'depth', 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['lft' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
