<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/20/2018
 * Time: 10:18 PM
 */

namespace core\entities\Blog\Post;


use core\entities\behaviors\MetaBehavior;
use core\entities\Blog\Category;
use core\entities\Blog\Type;
use core\entities\Meta;
use DomainException;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Post
 * @property integer $id
 * @property integer $created_at
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $rating
 * @property mixed categoryAssignments
 * @package core\entities\Blog\Post
 */
class Post extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_post}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['categoryAssignments', 'values'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public $meta;
    /**
     * @param $brandId
     * @param $categoryId
     * @param $name
     * @param Meta $meta
     * @return Post
     */
    public static function create($brandId, $categoryId, $name, Meta $meta): self
    {
        $post = new static();
        $post->brand_id = $brandId;
        $post->category_id = $categoryId;
        $post->name = $name;
        $post->meta = $meta;
        $post->created_at = time();
        return $post;
    }


    /**
     * @param $categoryId
     */
    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    /**
     * @param $id
     */
    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    /**
     * @param $id
     */
    public function revokeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignments is not found');
    }

    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    /**
     * @param $id
     */
    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    /**
     * @param $id
     */
    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    /**
     *
     */
    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    // Photos

    /**
     * @param UploadedFile $file
     */
    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->updatePhotos($photos);
    }

    /**
     * @param $id
     */
    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    /**
     *
     */
    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }



    /**
     * @return ActiveQuery
     */
    public function getType(): ActiveQuery
    {
        return $this->hasOne(Type::class, ['id' => 'brand_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasOne(CategoryAssignment::class, ['product_id' => 'id']);
    }


}










