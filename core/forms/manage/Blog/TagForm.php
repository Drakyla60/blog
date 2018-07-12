<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 1:29 PM
 */

namespace core\forms\manage\Blog;


use core\entities\Blog\Tag;
use yii\base\Model;

class TagForm extends Model
{
    public $name;
    public $slug;

    private $_tag;

    public function __construct( Tag $tag = null, $config = [])
    {
        if ($tag) {
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name','slug'], 'required'],
            [['name','slug'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '#^[a-z0-9_-]*$#s'],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Tag::class,
                'filter' => $this->_tag ? ['<>', 'id', $this->_tag->id] : null
            ],
        ];
    }
}