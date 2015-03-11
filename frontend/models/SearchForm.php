<?php

namespace frontend\models;

use yii\base\Model;

class SearchForm extends Model
{
    public $name;
    public $type;

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],

            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'max' => 100],

            ['type', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'type' => 'Тип',
        ];
    }
}