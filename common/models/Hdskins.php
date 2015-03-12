<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "hdskins".
 *
 * @property integer $id
 * @property string $name
 * @property source $file
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Hdskins extends ActiveRecord
{
    /**
     * @var string Url to hdskins
     */
    public $baseUrl;
    /**
     * @var string Path to hdskins
     */
    public $basePath;
    /**
     * @var resource Skin image
     */
    public $file;

    /**
     * Set path and url
     */
    public function init()
    {
        parent::init();

        $this->baseUrl = Yii::$app->params['frontendUrl'] . '/uploads/hdskins/';
        $this->basePath = Yii::getAlias('@frontend/web/uploads/hdskins/');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hdskins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'rate', 'views', 'downloads'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'image', 'mimeTypes' => 'image/png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'file' => 'Скин',
            'date' => 'Дата',
            'rate' => 'Рейтинг',
            'views' => 'Просмотров',
            'downloads' => 'Скачиваний',
        ];
    }

    /**
     * Get url of file
     *
     * @param int $id
     * @return string
     */
    public function getUrl($id)
    {
        return $this->baseUrl . $id . '.png';
    }

    /**
     * Get path of file
     *
     * @param int $id
     * @return string
     */
    public function getPath($id)
    {
        return $this->basePath . $id . '.png';
    }
}
