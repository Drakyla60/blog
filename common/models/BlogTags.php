<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_tags".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class BlogTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
        ];
    }

    /**
     * @inheritdoc
     * @return BlogTagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogTagsQuery(get_called_class());
    }
}
