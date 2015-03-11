<?php

namespace frontend\models;

use yii\base\Model;

class Official extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],

            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'max' => 100],
        ];
    }

    public function getUrl($name = false)
    {
        if ($name) $this->name = $name;

        $baseUrl = 'http://skins.minecraft.net/MinecraftSkins/';
        $url = $baseUrl . $this->name . '.png';

        if (is_array(getimagesize($url))) {
            return $url;
        }

        return false;
    }
}