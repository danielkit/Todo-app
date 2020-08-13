<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model {

    public $name;
    public $email;
    public $age;

    public function rules()
    {
        return
        [
            [['name', 'name'], 'required'],
            [['email', 'email'], 'required'],
            ['age', 'number']
        ];
    }
}
