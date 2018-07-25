<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/25/2018
 * Time: 3:26 PM
 */

namespace core\entities\Blog\Post;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property UploadedFile file
 * @property  $sort
 * @property  string $uploadedFile
 * @property mixed $id
 */
class Photo extends ActiveRecord
{
    /**
     * @param UploadedFile $uploadedFile
     * @return Photo
     */
    public static function create(UploadedFile $uploadedFile): self
    {
        $photo = new static();
        $photo->file = $uploadedFile;
        return $photo;
    }

    /**
     * @param $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id === $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%post_photos}}';
    }
}