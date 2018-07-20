<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 3:39 PM
 */

namespace core\forms\manage\Blog\Post;


use core\entities\Blog\Post\Post;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CategoriesForm
 * @package core\forms\manage\Blog\Post
 */
class CategoriesForm extends Model
{
    /**
     * @var
     */
    public $main;
    /**
     * @var array
     */
    public $others =[];

    /**
     * CategoriesForm constructor.
     * @param Post|null $post
     * @param array $config
     */
    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->main = $post->category_id;
            $this->others = ArrayHelper::getColumn($post->categoryAssignments, 'category_id');
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['main', 'required'],
            ['main', 'integer'],
            ['others', 'each', 'rule' => ['integer']],
        ];
    }
}