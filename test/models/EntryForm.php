<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 02.06.2019
 * Time: 17:13
 */

namespace app\models;

use yii\base\Model;
class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}