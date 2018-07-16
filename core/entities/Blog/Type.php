<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 4:00 PM
 */

namespace core\entities\Blog;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class Type
 * @package core\entities\Blog
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Type extends ActiveRecord
{

    public $meta;

    public static function tableName(): string
    {
        return '{{%blog_type}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
        ];
    }

    /**
     * @param $name
     * @param $slug
     * @param Meta $meta
     * @return Type
     */
    public static function create($name, $slug, Meta $meta): self
    {
        $type = new static();
        $type->name = $name;
        $type->slug = $slug;
        $type->meta = $meta;
        return $type;
    }

    /**
     * @param $name
     * @param $slug
     * @param Meta $meta
     */
    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }


}