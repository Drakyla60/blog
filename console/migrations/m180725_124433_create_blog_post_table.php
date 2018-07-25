<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_post`.
 */
class m180725_124433_create_blog_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_post', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'rating' => $this->decimal(3, 2),
            'meta_json' => $this->text(),
        ]);

        $this->createIndex('{{%idx-blog_post-category_id}}', '{{%blog_post}}', 'category_id');
        $this->createIndex('{{%idx-blog_post-type_id}}', '{{%blog_post}}', 'type_id');

        $this->addForeignKey('{{%fk-blog_post-category_id}}', '{{%blog_post}}', 'category_id', '{{%blog_categories}}', 'id');
        $this->addForeignKey('{{%fk-blog_post-type_id}}', '{{%blog_post}}', 'type_id', '{{%blog_type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_post');
    }
}
