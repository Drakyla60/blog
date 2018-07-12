<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 4:00 PM
 */

namespace core\entities\Blog;


use core\entities\Meta;
use yii\db\ActiveRecord;
use yii\helpers\Json;

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
    /**
     * @var
     */
    public $meta;


    public static function tableName(): string
    {
        return '{{%blog_type}}';
    }

    public function afterFind(): void
    {
        $meta = Json::decode($this->getAttribute('meta_json'));
        $this->meta = new Meta($meta['title'], $meta['description'], $meta['keywords']);
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('meta_json', Json::encode([
            'title' => $this->meta->title,
            'description' => $this->meta->description,
            'keywords' => $this->meta->keywords
        ]));
        return parent::beforeSave($insert);
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