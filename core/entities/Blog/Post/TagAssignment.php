<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/25/2018
 * Time: 7:27 PM
 */

namespace core\entities\Blog\Post;

use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $tag_id;
 */
class TagAssignment extends ActiveRecord
{
    /**
     * @param $tagId
     * @return TagAssignment
     */
    public static function create($tagId): self
    {
        $assignment = new static();
        $assignment->tag_id = $tagId;
        return $assignment;
    }
    /**
     * @param $id
     * @return bool
     */
    public function isForTag($id): bool
    {
        return $this->tag_id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_tag_assignments}}';
    }
}