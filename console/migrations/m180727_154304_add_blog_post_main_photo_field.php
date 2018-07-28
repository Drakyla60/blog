<?php

use yii\db\Migration;

/**
 * Class m180727_154304_add_blog_post_main_photo_field
 */
class m180727_154304_add_blog_post_main_photo_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_post}}', 'main_photo_id', $this->integer());

        $this->createIndex('{{%idx-blog_post-main_photo_id}}', '{{%blog_post}}', 'main_photo_id');

        $this->addForeignKey('{{%fk-blog_post-main_photo_id}}', '{{%blog_post}}',
            'main_photo_id', '{{%blog_photos}}', 'photo_id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-blog_post-main_photo_id}}', '{{%blog_post}}');

        $this->dropColumn('{{%blog_post}}', 'main_photo_id');
    }

}
