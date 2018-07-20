<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 10:18 PM
 */

namespace core\entities\Blog\Post;


use core\entities\behaviors\MetaBehavior;
use core\entities\Blog\Category;
use core\entities\Blog\Type;
use core\entities\Meta;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Post
 * @property integer $id
 * @property integer $created_at
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $rating
 * @package core\entities\Blog\Post
 */
class Post extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_post}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class
        ];
    }

    public $meta;
    /**
     * @param $brandId
     * @param $categoryId
     * @param $name
     * @param Meta $meta
     * @return Post
     */
    public static function create($brandId, $categoryId, $name, Meta $meta): self
    {
        $post = new static();
        $post->brand_id = $brandId;
        $post->category_id = $categoryId;
        $post->name = $name;
        $post->meta = $meta;
        $post->created_at = time();
        return $post;
    }

    /**
     * @return ActiveQuery
     */
    public function getType(): ActiveQuery
    {
        return $this->hasOne(Type::class, ['id' => 'brand_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


}