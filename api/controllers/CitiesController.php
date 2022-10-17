<?php

namespace api\controllers;

use api\models\Cities;

class CitiesController extends BaseController
{
    public $modelClass = Cities::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['update'], $actions['view'],);

        return $actions;
    }
}