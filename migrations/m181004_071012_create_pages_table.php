nn         <?php

use yii\db\Migration;

/**
 * Handles the creation of table `abdualiym_cms_pages`.
 */
class m181004_071012_create_pages_table extends Migration
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

        $this->createTable('{{%abdualiym_cms_pages}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string()->notNull(),
            'title_ru' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'alias' => $this->string()->notNull()->unique(),
            'content_uz' => 'MEDIUMTEXT',
            'content_ru' => ' MEDIUMTEXT',
            'content_en' => 'MEDIUMTEXT',
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-abdualiym_cms_pages-alias', 'abdualiym_cms_pages', 'alias');

        $this->createIndex('index-abdualiym_cms_pages-created_by', 'abdualiym_cms_pages', 'created_by');
        $this->addForeignKey('fkey-abdualiym_cms_pages-created_by', 'abdualiym_cms_pages', 'created_by', 'users', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-abdualiym_cms_pages-updated_by', 'abdualiym_cms_pages', 'updated_by');
        $this->addForeignKey('fkey-abdualiym_cms_pages-updated_by', 'abdualiym_cms_pages', 'updated_by', 'users', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('abdualiym_cms_pages');
    }
}
