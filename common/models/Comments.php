<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $comment
 * @property integer $user
 * @property boolean $status
 * @property int $created_at
 * @property int $updated_at
 */
class Comments extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return [
            'id',
            'comment',
            'status',
            'user',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['user'], 'integer'],
            [['status'], 'boolean'],
            [['status', 'comment'], 'required'],

            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'Пользователь',
            'comment' => 'Комментарий',
            'status' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function afterFind()
    {
        $this->user = Users::findOne(['id' => $this->user]);
    }

}
