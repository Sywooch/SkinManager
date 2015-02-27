<?php

namespace frontend\controllers;

class RequestsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
