<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_post`.
 */
class m180623_195343_create_blog_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_post', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'update_at' => $this->integer()->notNull(),
            'author' => $this->string(50)->notNull(),
            'slug' => $this->string(100)->notNull(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'content' => $this->text()->notNull(),
            'photo' => $this->string(),
            'status' => $this->integer(1)->defaultValue(0),
            'meta_json' => $this->json(),
            'comment_count' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_post');
    }
}
