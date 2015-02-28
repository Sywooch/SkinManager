<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cloaks".
 *
 * @property integer $id
 * @property string $name
 * @property source $file
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Cloaks extends ActiveRecord
{
	/**
	 * @var string Url to cloaks
	 */
	public $baseUrl;
	/**
	 * @var string Path to cloaks
	 */
	public $basePath;
	/**
	 * @var resource Cloak image
	 */
	public $file;

	public function init()
	{
		parent::init();
		
		$this->baseUrl = Yii::$app->params['frontendUrl'] . '/uploads/cloaks/';
		$this->basePath = Yii::getAlias('@frontend/web/uploads/cloaks/');
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cloaks';
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
            'file' => 'Плащ',
            'date' => 'Дата',
            'rate' => 'Рейтинг',
            'views' => 'Просмотров',
            'downloads' => 'Скачиваний',
        ];
    }

	/**
	 * Get url of skin with cloak by id
	 *
	 * @param int $id
	 * @return string
	 */
	public function getUrl($id)
	{
		return $this->baseUrl . $id . '.png';
	}

	/**
	 * Get path of skin with cloak by id
	 *
	 * @param int $id
	 * @return string
	 */
	public function getPath($id)
	{
		return $this->basePath . $id . '.png';
	}
}
