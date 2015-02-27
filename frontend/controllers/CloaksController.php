<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Cloaks;

class CloaksController extends Controller
{
    public function actionIndex()
    {
		$query = Cloaks::find();

        $pagination = new Pagination([
            'defaultPageSize' => 24,
            'totalCount' => $query->count(),
        ]);

        $cloaks = $query->orderBy('date')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'cloaks' => $cloaks,
            'pagination' => $pagination,
        ]);
    }

	public function actionView($id)
	{
		// TODO
	}

}
