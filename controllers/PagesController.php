<?php

namespace app\controllers;

use app\components\Helpers;
use app\models\Articles;
use app\models\Categories;
use app\models\Goods;
use app\models\Users;
use Yii;
use app\models\Pages;
use app\models\PagesSearch;
use yii\web\NotFoundHttpException;
use app\models\ContactsForm;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends AdminAccessController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($id = 'main')
    {
        $this->layout = "main";

        $model = $this->findModel($id);
        $categories = Categories::findAll(['parent' => 0]);
        $articles = Articles::find()->orderBy('date')->limit(3)->all();

        return $this->render('index', [
            'model' => $model,
            'categories' => $categories,
            'articles' => $articles
        ]);
    }

    /**
     * Displays contact page.
     * @return mixed
     */
    public function actionContacts()
    {
        $this->layout = "main";

        $model = $this->findModel('contacts');
        $model_contacts = new ContactsForm();

        $email = Users::find()->select('email')->where(['group_id' => Users::GROUP_ID_ADMIN])->scalar();

        if ($model_contacts->load(Yii::$app->request->post()) && $model_contacts->contact($email)) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contacts', [
            'model' => $model,
            'model_contacts' => $model_contacts,
        ]);
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionEditlist()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('editlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заданой страницы не существует.');
    }
}
