<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Skins;

class SkinsController extends Controller
{
    public function actionIndex()
    {
		$query = Skins::find();

        $pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);

        $skins = $query->orderBy('date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'skins' => $skins,
            'pagination' => $pagination,
        ]);
    }

	public function actionView($id)
	{
		$model = $this->findModel($id);
		$model->views = $model->views + 1;
		$model->save();

		return $this->render('view', [
            'model' => $model,
        ]);
	}

	public function actionRate($id, $type = 'up')
	{
		$session = Yii::$app->session;
		$model = $this->findModel($id);

		$voted = $session->get('voted_id');

		if ($voted) {
			$session->setFlash('alerts', 'Вы уже голосовали. Больше нельзя :(');
		} else {
			$model->rate = ($type == 'up') ? ($model->rate + 1) : ($model->rate - 1);
			$model->save();

			$session->set('voted_id', $model->id);
			$session->setFlash('alerts', 'Вы успешно проголосовали.');
		}

		return $this->redirect(['view', 'id' => $model->id]);
	}

	/**
     * Finds the Skins model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Skins the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Skins::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой скин не существует.');
        }
    }

}
