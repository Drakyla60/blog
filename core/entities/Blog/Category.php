<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/17/2018
 * Time: 12:03 PM
 */

namespace core\entities\Blog;


use core\entities\behaviors\MetaBehavior;
use core\entities\Blog\queries\CategoryQuery;
use core\entities\Meta;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;

/**
 * Class Category
 * @package core\entities\Blog
 * @property  $name
 * @property  $slug
 * @property  $title
 * @property  $description
 * @property  Meta $meta
 *
 * @property Category $parent
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    /**
     * @var
     */
    public $meta;

    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param Meta $meta
     * @return Category
     */
    public static function create($name, $slug, $title, $description, Meta $meta): self 
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param Meta $meta
     */
    public function edit($name, $slug, $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{blog_categories}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return CategoryQuery
     */
    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}