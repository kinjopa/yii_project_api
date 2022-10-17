<?php

namespace api\controllers;

use api\models\Cities;
use api\models\Files;
use api\models\Users;
use api\models\LoginForm;
use Psy\Util\Json;
use Yii;
use yii\web\UploadedFile;

class UsersController extends BaseController
{
    public $modelClass = Users::class;

    /**
     * Actions:
     * index: постраничный список ресурсов;
     * view: возвращает подробную информацию об указанном ресурсе;
     * create: создание нового ресурса;
     * update: обновление существующего ресурса;
     * delete: удаление указанного ресурса;
     * options: возвращает поддерживаемые HTTP-методы.
     * */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);

        return $actions;
    }


    /**
     * Проверяет права текущего пользователя.
     *
     * Этот метод должен быть переопределен, чтобы проверить, имеет ли текущий
     * пользователь право выполнения указанного действия над указанной моделью данных.
     * Если у пользователя нет доступа, следует выбросить исключение
     * [[ForbiddenHttpException]].
     *
     * @param string $action ID действия, которое надо выполнить
     * @param \yii\base\Model $model модель, к которой нужно получить доступ.
     * Если `null`, это означает, что модель, к которой нужно получить доступ,
     * отсутствует.
     * @param array $params дополнительные параметры
     * @throws ForbiddenHttpException если у пользователя нет доступа
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        // проверить, имеет ли пользователь доступ к $action и $model
        // выбросить ForbiddenHttpException, если доступ следует запретить

        if ($action !== 'create') {
            if (strval(Yii::$app->request->get('id')) !== strval(Yii::$app->user->getId()) and !Yii::$app->user->identity->getAdmin())
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }

    public function actionData(){
        return Yii::$app->user->identity;
    }

    /**
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            return [
                'access_token' => $model->login(),
            ];
        }
        return $model->getFirstErrors();
    }

    public function actionDelete(){
        return Json::encode('Не сегодня');
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest)
            throw new \yii\web\ForbiddenHttpException(sprintf('You are already logged in.'));

        $model = new Users();
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('password'));
            $model->auth_key = Yii::$app->security->generateRandomString();
            if (empty($model->city) or !Cities::findOne($model->city)) {
                $model->city = '';
            }

            if (!empty($model->avatar) and !is_int($model->avatar)) {
                $file_model = new Files();

                $file_model->file = UploadedFile::getInstance($model, 'avatar');
                $model->avatar = $file_model->upload();
            }

            $model->save();
            return true;
        }
        return $model->errors;
    }
}