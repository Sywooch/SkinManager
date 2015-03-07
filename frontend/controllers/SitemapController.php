<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use common\models\Skins;
use common\models\Hdskins;
use common\models\Cloaks;

class SitemapController extends Controller
{
    public $urls = [];

    public function actionIndex()
    {
        $this->urls = $this->getUrls();

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');

        $sitemap = $this->renderPartial('index', ['urls' => $this->urls]);

        return $sitemap;
    }

    public function getUrls()
    {
        $urls = [];

        $urls[] = Url::to(['site/index'], true);
        $urls[] = Url::to(['skins/index'], true);
        $urls[] = Url::to(['hdskins/index'], true);
        $urls[] = Url::to(['cloaks/index'], true);

        foreach (Skins::find()->all() as $item) {
            $urls[] = Url::to(['skins/view', 'id' => $item->id], true);
        }
        foreach (Hdskins::find()->all() as $item) {
            $urls[] = Url::to(['skins/view', 'id' => $item->id], true);
        }
        foreach (Cloaks::find()->all() as $item) {
            $urls[] = Url::to(['skins/view', 'id' => $item->id], true);
        }

        return $urls;
    }
}