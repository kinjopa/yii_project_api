<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m231003_101341_create_comments_table extends Migration
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

        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'user' => $this->integer(),
            'comment' => $this->text(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FC_user_id', '{{%comments}}', 'user', '{{%users}}', 'id');

        $this->insert('{{%comments}}', [
            'user' => 1,
            'comment' => 'Комментарий 1',
            'status' => true,

            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%comments}}', [
            'user' => 2,
            'comment' => 'Комментарий 1',
            'status' => true,

            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%comments}}', [
            'user' => 3,
            'comment' => 'Комментарий 1',
            'status' => true,

            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%comments}}', [
            'user' => 1,
            'comment' => 'Комментарий 2',
            'status' => true,

            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FC_user_id', '{{%comments}}');
        $this->dropTable('{{%comments}}');
    }
}
