<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_type`.
 */
class m180720_115228_create_blog_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'meta_json' => 'JSON NOT NULL',
        ]);

        $this->createIndex('{{%idx-blog_type-slug}}', '{{%blog_type}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_type');
    }
}
