<?php

namespace app\controllers;

use app\models\PassForm;
use app\models\Users;
use Yii;

class PrefsController extends AdminAccessController
{
    public function actionUpdate()
    {
        $model = Users::findIdentity(Yii::$app->user->id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Настройки успешно изменены');
            return $this->redirect('@web/admin');
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionUpdatepass()
    {
        $model = new PassForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = Users::findIdentity(Yii::$app->user->id);
            $user->pass = password_hash(Yii::$app->request->post('PassForm')['pass'], PASSWORD_DEFAULT);
            $user->save();
            Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            return $this->redirect('@web/admin');
        }

        return $this->render('updatepass', ['model' => $model]);
    }

}
