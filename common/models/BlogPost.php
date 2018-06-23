<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_post".
 *
 * @property int $id
 * @property int $category_id
 * @property int $created_at
 * @property int $update_at
 * @property string $author
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $photo
 * @property int $status
 * @property array $meta_json
 * @property int $comment_count
 */
class BlogPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at', 'update_at', 'status', 'comment_count'], 'integer'],
            [['created_at', 'update_at', 'author', 'slug', 'title', 'content'], 'required'],
            [['description', 'content', 'meta_json'], 'string'],
            [['author'], 'string', 'max' => 50],
            [['slug'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 150],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
            'author' => Yii::t('app', 'Author'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'photo' => Yii::t('app', 'Photo'),
            'status' => Yii::t('app', 'Status'),
            'meta_json' => Yii::t('app', 'Meta Json'),
            'comment_count' => Yii::t('app', 'Comment Count'),
        ];
    }

    /**
     * @inheritdoc
     * @return BlogPostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogPostQuery(get_called_class());
    }


}
