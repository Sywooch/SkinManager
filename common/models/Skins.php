<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skins".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date
 * @property integer $rate
 * @property integer $views
 * @property integer $downloads
 */
class Skins extends \yii\db\ActiveRecord
{
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
            [['name', 'date'], 'required'],
            [['date', 'rate', 'views', 'downloads'], 'integer'],
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
            'name' => 'Name',
            'date' => 'Date',
            'rate' => 'Rate',
            'views' => 'Views',
            'downloads' => 'Downloads',
        ];
    }
}
