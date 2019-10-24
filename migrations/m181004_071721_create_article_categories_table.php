<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_categories`.
 */
class m181004_071721_create_article_categories_table extends Migration
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

        $this->createTable('{{%article_categories}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'description_uz' => $this->text(),
            'description_ru' => $this->text(),
            'description_en' => $this->text(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-article_categories-alias', 'article_categories', 'alias');

        $this->createIndex('index-article_categories-created_by', 'article_categories', 'created_by');
        $this->addForeignKey('fkey-article_categories-created_by', 'article_categories', 'created_by', 'users', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-article_categories-updated_by', 'article_categories', 'updated_by');
        $this->addForeignKey('fkey-article_categories-updated_by', 'article_categories', 'updated_by', 'users', 'id', 'RESTRICT', 'RESTRICT');


        $this->insert('article_categories', [
            'title_uz' => 'Yangiliklar',
            'title_ru' => 'Новости',
            'title_en' => 'News',
            'alias' => 'news',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_categories');
    }
}
