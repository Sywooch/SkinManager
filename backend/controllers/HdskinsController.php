<?php

namespace backend\controllers;

use Yii;
use common\models\Hdskins;
use common\models\HdskinsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HdskinsController implements the CRUD actions for Hdskins model.
 */
class HdskinsController extends Controller
{
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
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

    /**
     * Lists all Hdskins models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HdskinsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hdskins model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hdskins model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hdskins();

        if ($model->load(Yii::$app->request->post())) {
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file && $model->validate()) {
				// Save model to DB
				$model->date = time();
				$model->save();

				// Save skin
				$model->file->saveAs($model->getPath($model->id));
				Yii::$app->skins->save($model);

				// Set success flash
				Yii::$app->session->setFlash('success', 'Вы успешно создали новый скин.');

				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				Yii::$app->session->setFlash('danger', 'Перепроверьте введенные данные.');

				return $this->render('create', [
					'model' => $model,
				]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hdskins model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
			$model->file = UploadedFile::getInstance($model, 'file');

			if ($model->file) {
				// Save original skin
				$model->file->saveAs($model->getPath($model->id));
				// Save cropped skin images
				Yii::$app->skins->save($model);
			}

			Yii::$app->session->setFlash('success', 'Вы успешно сохранили изменения.');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Hdskins model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		// Delete files
		@unlink($model->getPath($model->id));
		Yii::$app->skins->delete($model);
		// Delete model
		$model->delete();

		Yii::$app->session->setFlash('success', 'Вы успешно удалили скин.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hdskins model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hdskins the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hdskins::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой скин не существует');
        }
    }
}
