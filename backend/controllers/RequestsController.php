<?php

namespace backend\controllers;

use Yii;
use common\models\Requests;
use common\models\RequestsSearch;
use common\models\Skins;
use common\models\Hdskins;
use common\models\Cloaks;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * RequestsController implements the CRUD actions for Requests model.
 */
class RequestsController extends Controller
{
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'accept', 'update', 'delete'],
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
     * Lists all Requests models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requests model.
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
     * Updates an existing Requests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

	public function actionAccept($id)
	{
		$model = $this->findModel($id);

		if ($model->type === 'Скин') {
			$skinModel = new Skins();
			$skinModel->name = $model->name;
			$skinModel->date = $model->date;
			$skinModel->save();

			// Move original skin file
			rename($model->getPath($model->id), $skinModel->getPath($skinModel->id));
			// Save skin images
			Yii::$app->skins->save($skinModel);
			// Delete old images
			Yii::$app->skins->delete($model);
		} elseif ($model->type === 'HD Скин') {
			$hdskinModel = new Hdskins();
			$hdskinModel->name = $model->name;
			$hdskinModel->date = $model->date;
			$hdskinModel->save();

			// Move original skin file
			rename($model->getPath($model->id), $hdskinModel->getPath($hdskinModel->id));
			// Save skin images
			Yii::$app->skins->save($hdskinModel);
			// Delete old images
			Yii::$app->skins->delete($model);
		} elseif ($model->type === 'Плащ') {
			$cloakModel = new Cloaks();
			$cloakModel->name = $model->name;
			$cloakModel->date = $model->date;
			$cloakModel->save();

			// Move original skin file
			rename($model->getPath($model->id), $cloakModel->getPath($cloakModel->id));
			// Save skin images
			Yii::$app->cloaks->save($cloakModel);
			// Delete old images
			Yii::$app->cloaks->delete($model);
		}

		$model->delete();
		
		return $this->redirect(['index']);
	}

    /**
     * Deletes an existing Requests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

		unlink($model->getPath($model->id));

		if ($model->type === 'Скин' or $model->type === 'HD Скин') {
			Yii::$app->skins->delete($model);
		} elseif ($model->type === 'Плащ') {
			Yii::$app->cloaks->delete($model);
		}

		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Requests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
