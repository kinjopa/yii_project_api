<?php

namespace api\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $shortname
 * @property int $created_at
 * @property int $updated_at
 */
class Cities extends \common\models\Cities
{
    public function fields()
    {
        return ['id', 'name', 'shortname'];
    }

    public function extraFields()
    {
        return ['users'];
    }

    public function getUsers()
    {
        return $this->hasMany(Users::class, ['city' => 'id']);
    }
}
