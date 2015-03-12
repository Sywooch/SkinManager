<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\SearchForm;
use frontend\models\Official;
use common\models\HdskinsSearch;
use common\models\SkinsSearch;

class SearchController extends Controller
{
    public function actionIndex()
    {
        $model = new SearchForm();

        $dataProvider = false;
        $itemView = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            switch ($model->type) {
                case 1:
                default:
                    $searchModel = new SkinsSearch();
                    $itemView = '_skin';
                    break;

                case 2:
                    $searchModel = new HdskinsSearch();
                    $itemView = '_hdskin';
                    break;

                case 3:
                    $searchModel = new Official();
                    $searchModel->name = $model->name;

                    if ($searchModel->getUrl()) {
                        return $this->render('official', [
                            'model' => $searchModel,
                        ]);
                    }

                    Yii::$app->session->setFlash('danger', 'Ничего не найдено');

                    return $this->render('index', [
                        'model' => $model,
                        'dataProvider' => false,
                        'itemView' => false,
                    ]);
            }

            $dataProvider = $searchModel->search([
                $searchModel->formName() => [
                    'name' => $model->name,
                ],
            ]);

        }

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'itemView' => $itemView,
        ]);
    }

}
