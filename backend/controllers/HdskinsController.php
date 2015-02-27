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

				// Save file
				Yii::$app->skins->save($model->file->tempName, $model->id, 'hdskins');
				$model->file->saveAs($model->getPath($model->id));
			}

			return $this->redirect(['view', 'id' => $model->id]);
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
				Yii::$app->skins->save($model->file->tempName, $model->id, 'hdskins');
				$model->file->saveAs($model->getPath($model->id));
			}

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

		// Delete file
		@unlink($model->getPath($model->id));
		@unlink(Yii::getAlias('@frontend/web/uploads/hdskins/' . $model->id . '_front_90.png'));
		@unlink(Yii::getAlias('@frontend/web/uploads/hdskins/' . $model->id . '_front_200.png'));
		@unlink(Yii::getAlias('@frontend/web/uploads/hdskins/' . $model->id . '_back_90.png'));
		@unlink(Yii::getAlias('@frontend/web/uploads/hdskins/' . $model->id . '_back_200.png'));

		$model->delete();

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
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
    }
}
