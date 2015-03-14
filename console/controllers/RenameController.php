<?php

namespace console\controllers;

use common\models\Cloaks;
use common\models\Hdskins;
use common\models\Skins;
use \Yii;
use \yii\console\Controller;

class RenameController extends Controller
{
    public function actionDo($type)
    {
        if ($type === 'skins') {
            echo 'Starting renaming skins...' . "\n\n\n";

            foreach (Skins::find()->all() as $item) {
                $dir = Yii::getAlias('@frontend/web/uploads/skins/');
                $file = $dir . $item->name . '.png';
                $newFile = $dir . $item->id . '.png';

                echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

                if (!file_exists($file) and file_exists($newFile)) {
                    echo 'Already renamed' . "\n\n";
                    continue;
                } elseif (!file_exists($file) and !file_exists($newFile)) {
                    echo 'Original file (' . $file . ') doesn\'t exist' . "\n\n";
                    continue;
                }

                rename($file, $newFile);

                echo 'Successfully renamed' . "\n\n";
            }

            echo 'Job done!' . "\n\n\n";
            return 0;
        } elseif ($type === 'hdskins') {
            echo 'Starting renaming hdskins...' . "\n\n\n";

            foreach (Hdskins::find()->all() as $item) {
                $dir = Yii::getAlias('@frontend/web/uploads/hdskins/');
                $file = $dir . $item->name . '.png';
                $newFile = $dir . $item->id . '.png';

                echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

                if (!file_exists($file) and file_exists($newFile)) {
                    echo 'Already renamed' . "\n\n";
                    continue;
                } elseif (!file_exists($file) and !file_exists($newFile)) {
                    echo 'Original file (' . $file . ') doesn\'t exist' . "\n\n";
                    continue;
                }

                rename($file, $newFile);

                echo 'Successfully renamed' . "\n\n";
            }

            echo 'Job done!' . "\n\n\n";
            return 0;
        } elseif ($type === 'cloaks') {
            echo 'Starting renaming cloaks...' . "\n\n\n";

            foreach (Cloaks::find()->all() as $item) {
                $dir = Yii::getAlias('@frontend/web/uploads/cloaks/');
                $file = $dir . $item->name . '.png';
                $newFile = $dir . $item->id . '.png';

                echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

                if (!file_exists($file) and file_exists($newFile)) {
                    echo 'Already renamed' . "\n\n";
                    continue;
                } elseif (!file_exists($file) and !file_exists($newFile)) {
                    echo 'Original file (' . $file . ') doesn\'t exist' . "\n\n";
                    continue;
                }

                rename($file, $newFile);

                echo 'Successfully renamed' . "\n\n";
            }

            echo 'Job done!' . "\n\n\n";
            return 0;
        }
    }
}