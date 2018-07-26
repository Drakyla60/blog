<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/25/2018
 * Time: 9:33 PM
 */

namespace core\forms\manage\Blog\Post;

use core\entities\Blog\Post\Post;
use core\entities\Blog\Type;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property Type $typeId
 * @property Post $name
 */

class PostEditForm extends CompositeForm
{
    /**
     * @var Post
     */
    private $_post;

    /**
     * PostEditForm constructor.
     * @param Post $post
     * @param array $config
     */
    public function __construct(Post $post, $config = [])
    {
        $this->typeId = $post->id;
        $this->name = $post->name;
        $this->meta = new MetaForm($post->meta);
        $this->categories = new CategoriesForm($post);
        $this->tags = new TagsForm($post);
        $this->_post = $post;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['typeId', 'name'], 'required'],
            [['typeId'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function typesList(): array
    {
        return ArrayHelper::map(Type::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    /**
     * @return array
     */
    protected function internalForms(): array
    {
        return ['meta', 'categories', 'tags'];
    }
}