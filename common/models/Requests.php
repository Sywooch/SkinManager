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
            [['user_id', 'name', 'type'], 'required'],
            [['user_id', 'date'], 'integer'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 255]
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
}
