<?php

namespace app\controllers;

use app\components\SitemapFilter;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Users;

class AdminAccessController extends Controller
{
    public $layout = 'admin_main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'editlist', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->getIdentity()->group_id == Users::GROUP_ID_ADMIN;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => SitemapFilter::className(),
                'only' => ['create', 'update', 'delete']
            ]
        ];
    }
}