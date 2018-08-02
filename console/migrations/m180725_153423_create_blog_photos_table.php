<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_photos`.
 */
class m180725_153423_create_blog_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_photos}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-blog_photos-product_id}}', '{{%blog_photos}}', 'id');

        $this->addForeignKey('{{%fk-blog_photos-photo_id}}', '{{%blog_photos}}',
            'post_id', '{{%blog_post}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_photos');
    }
}
