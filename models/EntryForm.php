<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $link;
    public $limit;
    public $time;

    public function rules()
    {
        return [
            [['link', 'limit', 'time'], 'required'],
            [['limit', 'time'], 'integer'],
            [['link'], 'url']
        ];
    }
}