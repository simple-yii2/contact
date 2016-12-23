<?php

namespace cms\contact\backend\models;

use Yii;
use yii\base\Model;

/**
 * Phone form
 */
class PhoneForm extends Model
{

	/**
	 * @var string phone number
	 */
	public $number;

	/**
	 * @var string description of phone number
	 */
	public $description;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'number' => Yii::t('contact', 'Number'),
			'description' => Yii::t('contact', 'Description'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['number', 'string', 'max' => 30],
			['description', 'string', 'max' => 100],
			['number', 'required'],
		];
	}

}
