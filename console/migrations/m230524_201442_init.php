<?php

use yii\db\Migration;

class m230524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),

            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'expire_at' => $this->dateTime(),

            'email' => $this->string()->notNull()->unique(),
            'city' => $this->integer(),
            'phone' => $this->string('20'),
            'avatar' => $this->integer(),
            'admin' => $this->boolean()->defaultValue(false),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FC_city_id', '{{%users}}', 'city', '{{%cities}}', 'id');
        $this->addForeignKey('FC_avatar_id', '{{%users}}', 'avatar', '{{%files}}', 'id');


        $this->insert('{{%users}}', [
            'name' => 'Семен',
            'patronymic' => 'Семенович',
            'surname' => 'Командирович',

            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),

            'email' => 'admin@mail.ru',
            'city' => 1,
            'phone' => '75845951242',
            'admin' => true,
            'avatar' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(32),

            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%users}}', [
            'name' => 'Антон',
            'patronymic' => 'Палыч',
            'surname' => 'Семенов',

            'password_hash' => Yii::$app->security->generatePasswordHash('user'),

            'email' => 'user@mail.ru',
            'city' => 2,
            'phone' => '79652145632',
            'admin' => false,
            'avatar' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(32),

            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%users}}', [
            'name' => 'Никита',
            'patronymic' => 'Сергеевич',
            'surname' => 'Петров',

            'password_hash' => Yii::$app->security->generatePasswordHash('sergey'),

            'email' => 'sergey@mail.ru',
            'city' => 1,
            'phone' => '7542158621',
            'admin' => false,
            'avatar' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(32),

            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropForeignKey('FC_city_id', '{{%users}}');
        $this->dropForeignKey('FC_avatar_id', '{{%users}}');
        $this->dropTable('{{%users}}');
    }
}
