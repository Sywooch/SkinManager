<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Requests;

class RequestsController extends Controller
{
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'skin', 'hdskin', 'cloak'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSkin()
    {
		$model = new Requests(['scenario' => 'skin']);

		if ($model->load(Yii::$app->request->post())) {
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file && $model->validate()) {
				$model->user_id = Yii::$app->user->getId();
				$model->date = time();
				$model->type = 'Скин';

				$model->save();

				// Save skin
				$model->file->saveAs($model->getPath($model->id));
				Yii::$app->skins->save($model);

				// Set success flash
				Yii::$app->session->setFlash('success', 'Вы успешно добавили скин.');
				
				return $this->redirect(['index']);
			} else {
				Yii::$app->session->setFlash('danger', 'Перепроверьте введенные данные.');
			}
		}

		return $this->render('skin', ['model' => $model]);
    }

    public function actionHdskin()
    {
		$model = new Requests(['scenario' => 'hdskin']);

		if ($model->load(Yii::$app->request->post())) {
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file && $model->validate()) {
				$model->user_id = Yii::$app->user->getId();
				$model->date = time();
				$model->type = 'HD Скин';

				$model->save();

				// Save skin
				$model->file->saveAs($model->getPath($model->id));
				Yii::$app->skins->save($model);

				// Set success flash
				Yii::$app->session->setFlash('success', 'Вы успешно добавили HD скин.');

				return $this->redirect(['index']);
			} else {
				Yii::$app->session->setFlash('danger', 'Перепроверьте введенные данные.');
			}
		}

		return $this->render('hdskin', ['model' => $model]);
    }

    public function actionCloak()
    {
		$model = new Requests(['scenario' => 'cloak']);

		if ($model->load(Yii::$app->request->post())) {
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file && $model->validate()) {
				$model->user_id = Yii::$app->user->getId();
				$model->date = time();
				$model->type = 'Плащ';

				$model->save();

				// Save skin
				$model->file->saveAs($model->getPath($model->id));
				Yii::$app->cloaks->save($model);

				// Set success flash
				Yii::$app->session->setFlash('success', 'Вы успешно добавили плащ.');

				return $this->redirect(['index']);
			} else {
				Yii::$app->session->setFlash('danger', 'Перепроверьте введенные данные.');
			}
		}

		return $this->render('cloak', ['model' => $model]);
    }

}
