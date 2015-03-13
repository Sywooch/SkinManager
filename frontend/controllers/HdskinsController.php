<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Cookie;
use yii\data\Pagination;
use yii\data\Sort;
use common\models\Hdskins;

/**
 * HdskinsController for rendering hd skins
 */
class HdskinsController extends Controller
{
    /**
     * Shows all the skins with pages
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'name',
                'date' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'rate' => [
                    'asc' => ['rate' => SORT_ASC],
                    'desc' => ['rate' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
                'downloads' => [
                    'asc' => ['rate' => SORT_ASC],
                    'desc' => ['rate' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
                'date' => SORT_DESC,
            ],
        ]);

        $query = Hdskins::find();
        $count = $query->count();

        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->params['per_page'],
            'totalCount' => $count,
        ]);

        $models = $query->orderBy($sort->orders)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
            'count' => $count,
            'sort' => $sort,
        ]);
    }

    /**
     * Renders single skin and +1 view for it
     *
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $name = md5('viewhdskin_' . $model->id);

        $session = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;

        if (!$session->has($name) and $cookies->has($name)) {
            $session->set($name, $model->id);
        }

        if (!$cookies->has($name) and $session->has($name)) {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => $name,
                'value' => $model->id,
                'expire' => time() + 31556926,
            ]));
        }

        if (!$session->has($name) and !$cookies->has($name)) {
            $model->views = $model->views + 1;

            $session->set($name, $model->id);

            Yii::$app->response->cookies->add(new Cookie([
                'name' => $name,
                'value' => $model->id,
                'expire' => time() + 31556926,
            ]));

            $model->save();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Add +1 to the model rate
     * @param int $id
     * @param boolean $up
     * @return mixed
     */
    public function actionRate($id, $up = true)
    {
        $model = $this->findModel($id);

        $name = md5('hdskins_' . $model->id);

        $session = Yii::$app->session;
        $cookies = Yii::$app->request->cookies;


        if (!$session->has($name) and $cookies->has($name)) {
            $session->set($name, $model->id);
        }

        if (!$cookies->has($name) and $session->has($name)) {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => $name,
                'value' => $model->id,
                'expire' => time() + 31556926,
            ]));
        }

        if ($session->has($name) and $cookies->has($name)) {
            $session->setFlash('danger', 'Ваш голос уже был учтен ранее.');
        } else {
            $model->rate = $up ? ($model->rate + 1) : ($model->rate - 1);

            $session->set($name, $model->id);

            Yii::$app->response->cookies->add(new Cookie([
                'name' => $name,
                'value' => $model->id,
                'expire' => time() + 31556926,
            ]));

            $model->save();

            $session->setFlash('success', 'Голос защитан. Текущий рейтинг: ' . $model->rate);
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Download skin file
     *
     * @param int $id ID of skin
     * @return mixed
     */
    public function actionDownload($id)
    {
        $model = $this->findModel($id);
        $model->downloads = $model->downloads + 1;
        $model->save();

        $file = Yii::getAlias('@frontend/web/uploads/hdskins/' . $model->id . '.png');

        return Yii::$app->response->sendFile($file, $model->name . '.png');
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
            throw new NotFoundHttpException('HD Скин с таким ID не существует. Проверьте запрошенный адрес');
        }
    }

}
