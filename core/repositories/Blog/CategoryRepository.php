<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/18/2018
 * Time: 8:53 PM
 */

namespace core\repositories\Blog;


use core\entities\Blog\Category;
use core\repositories\NotFoundException;
use RuntimeException;

/**
 * Class CategoryRepository
 * @package core\repositories\Blog
 */
class CategoryRepository
{
    /**
     * @param $id
     * @return Category
     */
    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    /**
     * @param Category $category
     */
    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Category $category
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}