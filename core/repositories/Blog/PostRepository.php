<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 10:16 PM
 */

namespace core\ropositories\Blog;


use core\entities\Blog\Post\Post;
use core\repositories\NotFoundException;
use RuntimeException;

/**
 * Class PostRepository
 * @package core\ropositories\Blog
 */
class PostRepository
{
    /**
     * @param $id
     * @return Post
     */
    public function get($id): Post
    {
        if (!$post = Post::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $post;
    }

    /**
     * @param $id
     * @return bool
     */
    public function existsByBrand($id): bool
    {
        return Post::find()->andWhere(['brand_id' => $id])->exists();
    }

    /**
     * @param $id
     * @return bool
     */
    public function existsByMainCategory($id): bool
    {
        return Post::find()->andWhere(['category_id' => $id])->exists();
    }

    /**
     * @param Post $post
     */
    public function save(Post $post): void
    {
        if (!$post->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Post $post
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Post $post): void
    {
        if (!$post->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}