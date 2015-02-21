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
            [['user_id', 'date', 'name'], 'required'],
            [['user_id', 'date'], 'integer'],
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
            'user_id' => 'User ID',
            'date' => 'Date',
            'name' => 'Name',
        ];
    }
}
