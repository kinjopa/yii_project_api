<?php

namespace api\models;

use Yii;
use yii\helpers\Url;

class Files extends \common\models\Files
{
    public $file;

    public function rules()
    {
        return [
            'file', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
            'checkExtensionByMimeType' => true,
            'maxSize' => 10240000,
            'tooBig' => 'Limit is 10 MB'
        ];
    }

//    public function upload()
//    {
//        if ($this->validate()) {
//            $dir = Url::home(true) . Yii::getAlias('@images');
//            $name = $this->file->baseName . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $this->file->extension;
//            $this->file->saveAs($dir . $name);
//
//            $this->name = $this->file->baseName;
//            $this->url = $dir . $name;
//            $this->type = $this->file->type;
//            unset($this->file);
//
//            if ($this->save())
//                return $this->id;
//        }
//        return false;
//    }

}