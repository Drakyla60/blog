<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/25/2018
 * Time: 3:25 PM
 */

namespace core\entities\Blog\Post;

use yii\db\ActiveRecord;


/**
 * @property integer $product_id;
 * @property integer $category_id;
 */
class CategoryAssignment extends ActiveRecord
{
    /**
     * @param $categoryId
     * @return CategoryAssignment
     */
    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%shop_category_assignments}}';
    }
}