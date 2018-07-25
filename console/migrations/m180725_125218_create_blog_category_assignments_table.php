<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_category_assignments`.
 */
class m180725_125218_create_blog_category_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_category_assignments}}', [
            'post_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-blog_category_assignments}}',
            '{{%blog_category_assignments}}', ['post_id', 'category_id']);

        $this->createIndex('{{%idx-blog_category_assignments-post_id}}',
            '{{%blog_category_assignments}}', 'post_id');

        $this->createIndex('{{%idx-blog_category_assignments-blog_id}}',
            '{{%blog_category_assignments}}', 'category_id');

        $this->addForeignKey('{{%fk-blog_category_assignments-post_id}}',
            '{{%blog_category_assignments}}', 'post_id',
            '{{%blog_post}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addForeignKey('{{%fk-blog_category_assignments-category_id}}',
            '{{%blog_category_assignments}}', 'category_id',
            '{{%blog_categories}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_category_assignments');
    }
}
