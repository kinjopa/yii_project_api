<?php

namespace api\models;

use DateTime;
use Yii;

class Comments extends \common\models\Comments
{
    public function fields()
    {
        return [
            'id',
            'comment',
            'status',
            'author',
            'created_at',
            'updated_at',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Users::class, ['id' => 'user']);
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function afterFind()
    {
        $this->created_at = Yii::$app->formatter->asDatetime($this->created_at, 'd.M.Y H:m');
        $this->updated_at = Yii::$app->formatter->asDatetime($this->updated_at, 'd.M.Y H:m');
    }

}