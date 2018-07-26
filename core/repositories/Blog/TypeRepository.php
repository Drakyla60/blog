<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 6:17 PM
 */

namespace core\repositories\Blog;

use core\entities\Blog\Type;
use core\repositories\NotFoundException;
use RuntimeException;

/**
 * Class TypeRepository
 * @package core\ropositories\Blog
 */
class TypeRepository
{
    /**
     * @param $id
     * @return Type
     */
    public function get($id): Type
    {
        if (!$type = Type::findOne($id)) {
            throw new NotFoundException('Brand is not found.');
        }
        return $type;
    }

    /**
     * @param Type $type
     */
    public function save(Type $type): void
    {
        if (!$type->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Type $type
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Type $type): void
    {
        if (!$type->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}