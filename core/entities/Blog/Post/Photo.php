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
use yiidreamteam\upload\ImageUploadBehavior;

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
        return $this->id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_photos}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/post/[[attribute_post_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/post/[[attribute_post_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/post/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/post/[[attribute_post_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],

                ],
            ],
        ];
    }
}