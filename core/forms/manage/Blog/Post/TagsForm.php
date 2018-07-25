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
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class TagsForm
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
            ['textNew', 'string']
        ];
    }

    /**
     * @return array
     */
    public function getNewNames(): array
    {
        return array_map('trim',preg_split('#\s*,\s*#i', $this->textNew));
    }
}