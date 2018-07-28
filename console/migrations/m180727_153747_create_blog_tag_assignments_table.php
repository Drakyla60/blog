<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_tag_assignments`.
 */
class m180727_153747_create_blog_tag_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_tag_assignments}}', [
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-blog_tag_assignments}}', '{{%blog_tag_assignments}}', ['post_id', 'tag_id']);

        $this->createIndex('{{%idx-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id');
        $this->createIndex('{{%idx-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id');

        $this->addForeignKey('{{%fk-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}',
            'post_id', '{{%blog_post}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}',
            'tag_id', '{{%blog_tags}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_tag_assignments');
    }
}
