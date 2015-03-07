<?php

namespace backend\controllers;

use Yii;
use common\models\Cloaks;
use common\models\CloaksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CloaksController implements the CRUD actions for Cloaks model.
 */
class CloaksController extends Controller
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
     * Lists all Cloaks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CloaksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cloaks model.
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
     * Creates a new Cloaks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cloaks();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                // Save model to DB
                $model->date = time();
                $model->save();

                // Save file
                $model->file->saveAs($model->getPath($model->id));
                Yii::$app->cloaks->save($model);

                // Set success flash
                Yii::$app->session->setFlash('success', 'Вы успешно создали новый плащ.');

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
     * Updates an existing Cloaks model.
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
                $model->file->saveAs($model->getPath($model->id));
                Yii::$app->cloaks->save($model);
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
     * Deletes an existing Cloaks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // Get model
        $model = $this->findModel($id);
        // Delete files
        @unlink($model->getPath($model->id));
        Yii::$app->cloaks->delete($model);
        // Delete model
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cloaks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cloaks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cloaks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой плащ не существует');
        }
    }
}
