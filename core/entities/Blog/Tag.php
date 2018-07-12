<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 1:04 PM
 */
namespace core\entities\Blog;

use yii\db\ActiveRecord;
/**
 * Class Tag
 * @package core\entities\Blog
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%blog_tags}}';
    }

    /**
     * @param $name
     * @param $slug
     * @return Tag
     */
    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    /**
     * @param $name
     * @param $slug
     */
    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }
}