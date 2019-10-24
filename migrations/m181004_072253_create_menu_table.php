<?php

use yii\db\Migration;

/**
 * Handles the creation of table `abdualiym_cms_menu`.
 */
class m181004_072253_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%abdualiym_cms_menu}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title_uz' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'type_helper' => $this->string(),
            'sort' => $this->integer()->notNull()->defaultValue(1),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-abdualiym_cms_menu-created_by', 'abdualiym_cms_menu', 'created_by');
        $this->addForeignKey('fkey-abdualiym_cms_menu-created_by', 'abdualiym_cms_menu', 'created_by', 'users', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-abdualiym_cms_menu-updated_by', 'abdualiym_cms_menu', 'updated_by');
        $this->addForeignKey('fkey-abdualiym_cms_menu-updated_by', 'abdualiym_cms_menu', 'updated_by', 'users', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('abdualiym_cms_menu');
    }
}
