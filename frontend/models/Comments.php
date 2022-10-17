<?php

namespace frontend\models;

use yii\base\Model;
use yii\behaviors\TimestampBehavior;

/**
 * Comments model
 *
 * @property integer $id
 * @property string $comment
 * @property bool $status
 *
 * @property integer $created_at
 * @property integer $updated_at
 */

class Comments extends Model
{
    public $comment;
    public $id;
    public $status;
    public $created_at;
    public $updated_at;

    public function fields()
    {
        return [
            'id',
            'comment',
            'status',
            'created_at',
            'updated_at',
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
            [['status'], 'boolean'],
            [['comment', 'status'], 'required'],
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
}