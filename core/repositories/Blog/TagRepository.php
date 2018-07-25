<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/12/2018
 * Time: 1:41 PM
 */

namespace core\ropositories\Blog;


use core\entities\Blog\Tag;
use core\repositories\NotFoundException;
use RuntimeException;

/**
 * Class TagRepository
 * @package core\ropositories\Blog
 */
class TagRepository
{
    /**
     * @param $id
     * @return Tag
     */
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found. ');
        }
        return $tag;
    }

    /**
     * @param Tag $tag
     */
    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new RuntimeException('Saving Error. ');
        }
    }


    /**
     * @param $name
     * @return Tag|null
     */
    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    /**
     * @param Tag $tag
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new RuntimeException('Removing error. ');
        }
    }
}