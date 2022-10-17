<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m221003_101330_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci';
        }

        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100'),
            'url' => $this->string(),
            'type' => $this->string(100),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%files}}', [
            'name' => 'it-cat',
            'url' => '/it-cat.jpg',
            'type' => 'img',

            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
