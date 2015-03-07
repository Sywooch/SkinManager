<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "skins".
 *
 * @property integer $id
 * @property string $name
 * @property source $file
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Skins extends ActiveRecord
{
    /**
     * @var string Url to skins
     */
    public $baseUrl;
    /**
     * @var string Path to skins
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

        // Set base paths and urls
        $this->baseUrl = Yii::$app->params['frontendUrl'] . '/uploads/skins/';
        $this->basePath = Yii::getAlias('@frontend/web/uploads/skins/');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skins';
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
            [['file'], 'image', 'mimeTypes' => 'image/png', 'maxHeight' => 64, 'maxWidth' => 64],
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
     * Get url of skin by id
     *
     * @param int $id
     * @return string
     */
    public function getUrl($id)
    {
        return $this->baseUrl . $id . '.png';
    }

    /**
     * Get path of skin by id
     *
     * @param int $id
     * @return string
     */
    public function getPath($id)
    {
        return $this->basePath . $id . '.png';
    }
}
