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
use core\validators\SlugValidator;
use yii\base\Model;

/**
 * Class TagForm
 * @package core\forms\manage\Blog
 */
class TagForm extends Model
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $slug;

    /**
     * @var Tag
     */
    private $_tag;

    /**
     * TagForm constructor.
     * @param Tag|null $tag
     * @param array $config
     */
    public function __construct(Tag $tag = null, $config = [])
    {
        if ($tag) {
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name','slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [
                ['name', 'slug'],
                'unique',
                'targetClass' => Tag::class,
                'filter' => $this->_tag ? ['<>', 'id', $this->_tag->id] : null
            ],
        ];
    }
}