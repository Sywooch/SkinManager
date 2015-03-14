<?php

namespace console\controllers;

use Yii;
use common\models\Cloaks;
use common\models\Hdskins;
use common\models\Skins;
use yii\console\Controller;

class RenameController extends Controller
{
    public function actionIndex($type, $debug = false)
    {
        if ($type === 'skins') {
            $this->renameSkins($debug);
        } elseif ($type === 'hdskins') {
            $this->renameHdskins($debug);
        } elseif ($type === 'cloaks') {
            $this->renameCloaks($debug);
        }
    }

    protected function renameSkins($debug)
    {
        echo 'Renaming skins...' . "\n";

        $fp = fopen(Yii::getAlias('@runtime/skins.txt'), 'a+');
        fwrite($fp, 'Непереименованные скины:' . "\r\n\r\n");

        foreach (Skins::find()->all() as $item) {
            $dir = Yii::getAlias('@frontend/web/uploads/skins/');
            $file = $dir . trim($item->name) . '.png';
            $newFile = $dir . $item->id . '.png';

            if ($debug) echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

            if (!file_exists($file) and file_exists($newFile)) {
                if ($debug) echo 'Already renamed' . "\n\n";

                continue;
            } elseif (!file_exists($file) and !file_exists($newFile)) {
                echo 'Error: Original file (' . $file . ') doesn\'t exist' . "\n\n";

                fwrite($fp, 'ID: ' . $item->id . ' | Название: ' . $item->name . ' | Причина: старый файл не найден' . "\r\n");

                continue;
            }

            rename($file, $newFile);

            if ($debug) echo 'Successfully renamed' . "\n\n";
        }

        fwrite($fp, "\r\n\r\n");
        fclose($fp);

        echo 'Renaming ended' . "\n";
        return 0;
    }

    protected function renameHdskins($debug)
    {
        echo 'Renaming hdskins...' . "\n";

        $fp = fopen(Yii::getAlias('@runtime/hdskins.txt'), 'a+');
        fwrite($fp, 'Непереименованные HD Скины:' . "\r\n\r\n");

        foreach (Hdskins::find()->all() as $item) {
            $dir = Yii::getAlias('@frontend/web/uploads/hdskins/');
            $file = $dir . trim($item->name) . '.png';
            $newFile = $dir . $item->id . '.png';

            if ($debug) echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

            if (!file_exists($file) and file_exists($newFile)) {
                if ($debug) echo 'Already renamed' . "\n\n";
                continue;
            } elseif (!file_exists($file) and !file_exists($newFile)) {
                echo 'Error: Original file (' . $file . ') doesn\'t exist' . "\n\n";

                fwrite($fp, 'ID: ' . $item->id . ' | Название: ' . $item->name . ' | Причина: старый файл не найден' . "\r\n");

                continue;
            }

            rename($file, $newFile);

            if ($debug) echo 'Successfully renamed' . "\n\n";
        }

        fwrite($fp, "\r\n\r\n");
        fclose($fp);

        echo 'Renaming ended' . "\n";
        return 0;
    }

    protected function renameCloaks($debug)
    {
        echo 'Renaming cloaks...' . "\n";

        $fp = fopen(Yii::getAlias('@runtime/cloaks.txt'), 'a+');
        fwrite($fp, 'Непереименованные Плащи:' . "\r\n\r\n");

        foreach (Cloaks::find()->all() as $item) {
            $dir = Yii::getAlias('@frontend/web/uploads/cloaks/');
            $file = $dir . trim($item->name) . '.png';
            $newFile = $dir . $item->id . '.png';

            if ($debug) echo 'Renaming (' . $file . ') to (' . $newFile . ")\n";

            if (!file_exists($file) and file_exists($newFile)) {
                if ($debug) echo 'Already renamed' . "\n\n";
                continue;
            } elseif (!file_exists($file) and !file_exists($newFile)) {
                echo 'Error: Original file (' . $file . ') doesn\'t exist' . "\n\n";


                fwrite($fp, 'ID: ' . $item->id . ' | Название: ' . $item->name . ' | Причина: старый файл не найден' . "\r\n");

                continue;
            }

            rename($file, $newFile);

            if ($debug) echo 'Successfully renamed' . "\n\n";
        }

        fwrite($fp, "\r\n\r\n");
        fclose($fp);

        echo 'Renaming ended' . "\n";
        return 0;
    }
}