<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cloaks".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Cloaks extends \yii\db\ActiveRecord
{
	/**
	 * Path and URL to uploaded cloak file
	 *
	 * @vars string
	 */
	public $uploadUrl;
	public $uploadPath;
	
	/**
	 * Cloak file
	 *
	 * @var file input
	 */
	public $file;

	public function init()
	{
		parent::init();
		
		$this->uploadUrl = Yii::$app->params['frontendUrl'] . '/uploads/cloaks/';
		$this->uploadPath = Yii::getAlias('@frontend/web/uploads/cloaks/');
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
            [['name'], 'required'],
            [['date', 'rate', 'views', 'downloads'], 'integer'],
            [['name'], 'string', 'max' => 255],
			[['file'], 'file', 'mimeTypes' => 'image/png'],
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
            'file' => 'Файл',
            'date' => 'Дата',
            'rate' => 'Рейтинг',
            'views' => 'Просмторов',
            'downloads' => 'Скачиваний',
        ];
    }

	public function getUrl($id)
	{
		return $this->uploadUrl . $id . '.png';
	}

	public function getPath($id)
	{
		return $this->uploadPath . $id . '.png';
	}
}
