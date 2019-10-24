<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m181004_071728_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'title_uz' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'content_uz' => 'MEDIUMTEXT',
            'content_ru' => 'MEDIUMTEXT',
            'content_en' => 'MEDIUMTEXT',
            'date' => $this->integer()->unsigned(),
            'photo' => $this->string(),
            'status' => $this->tinyInteger()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-articles-alias', 'articles', 'alias', true);
        $this->createIndex('index-articles-status', 'articles', 'status');

        $this->createIndex('index-articles-category_id', 'articles', 'category_id');
        $this->addForeignKey('fkey-articles-category_id', 'articles', 'category_id', 'article_categories', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-articles-created_by', 'articles', 'created_by');
        $this->addForeignKey('fkey-articles-created_by', 'articles', 'created_by', 'users', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-articles-updated_by', 'articles', 'updated_by');
        $this->addForeignKey('fkey-articles-updated_by', 'articles', 'updated_by', 'users', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');
    }
}
