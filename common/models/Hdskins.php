<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hdskins".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Hdskins extends \yii\db\ActiveRecord
{
	/**
	 * Path and URL to uploaded cloak file
	 *
	 * @vars string
	 */
	public $uploadUrl;
	public $uploadPath;

	/**
	 * HD skin file
	 *
	 * @var file input
	 */
	public $file;

	public function init()
	{
		parent::init();

		$this->uploadUrl = Yii::$app->params['frontendUrl'] . '/uploads/hdskins/';
		$this->uploadPath = Yii::getAlias('@frontend/web/uploads/hdskins/');
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
		return $this->uploadUrl . $id . '.png';
	}

	/**
	 * Get path of file
	 *
	 * @param int $id
	 * @return string
	 */
	public function getPath($id)
	{
		return $this->uploadPath . $id . '.png';
	}
}
