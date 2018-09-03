<?php

namespace cms\contact\backend\forms;

use Yii;
use yii\base\Model;

/**
 * E-mail form
 */
class EmailForm extends Model
{

    /**
     * @var string e-mail
     */
    public $email;

    /**
     * @var string description of e-mail
     */
    public $description;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('contact', 'E-mail'),
            'description' => Yii::t('contact', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'description'], 'string', 'max' => 100],
            ['email', 'required'],
        ];
    }

}
