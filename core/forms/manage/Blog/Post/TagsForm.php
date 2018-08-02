<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 3:28 PM
 */

namespace core\forms\manage\Blog\Post;


use core\entities\Blog\Post\Post;
use core\entities\Blog\Tag;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class TagsForm
 * @property array $newNames
 * @package core\forms\manage\Blog\Post
 */
class TagsForm extends Model
{
    /**
     * @var array
     */
    public $existing = [];
    /**
     * @var
     */
    public $textNew;

    /**
     * TagsForm constructor.
     * @param Post|null $post
     * @param array $config
     */
    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->existing = ArrayHelper::getColumn($post->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['existing', 'default', 'value' => []],
            ['textNew', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function tagsList(): array
    {
        return ArrayHelper::map(Tag::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
    /**
     * @return array
     */
    public function getNewNames(): array
    {
        return array_filter(array_map('trim', preg_split('#\s*,\s*#i', $this->textNew)));
    }
}