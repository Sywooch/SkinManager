<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $date
 * @property string $name
 * @property string $type
 */
class Requests extends \yii\db\ActiveRecord
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
	 * @var resource File with skin/cloak
	 */
	public $file;

	/**
	 * Set path and url
	 */
	public function init()
	{
		parent::init();

		// Set base paths and urls
		$this->baseUrl = Yii::$app->params['frontendUrl'] . '/uploads/requests/';
		$this->basePath = Yii::getAlias('@frontend/web/uploads/requests/');
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'file'], 'required'],
            [['user_id', 'date'], 'integer'],

            [['type'], 'string'],

            [['name'], 'string', 'max' => 255],

            [['file'], 'image', 'mimeTypes' => 'image/png', 'maxHeight' => 64, 'maxWidth' => 64, 'on' => 'skin'],
            [['file'], 'image', 'mimeTypes' => 'image/png', 'maxHeight' => 1024, 'maxWidth' => 1024, 'on' => 'hdskin'],
            [['file'], 'image', 'mimeTypes' => 'image/png', 'maxHeight' => 64, 'maxWidth' => 64, 'on' => 'cloak'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'Файл',
            'user_id' => 'ID Пользователя',
            'name' => 'Название',
            'type' => 'Тип',
            'date' => 'Дата',
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
