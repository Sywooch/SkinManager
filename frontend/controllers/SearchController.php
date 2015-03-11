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
                    return $this->render('official', [
                        'model' => $searchModel,
                    ]);
            }

            $dataProvider = $searchModel->search([
                $searchModel->formName() => [
                    'name' => $model->name,
                ],
            ]);

            return $this->render('result', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'itemView' => $itemView,
            ]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

}
