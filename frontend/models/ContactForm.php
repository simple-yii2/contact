<?php

namespace simple\contacts\frontend\models;

use Yii;
use yii\base\Model;

/**
 * Contact form
 */
class ContactForm extends Model
{

	/**
	 * @var string Name
	 */
	public $name;

	/**
	 * @var string Phone
	 */
	public $phone;

	/**
	 * @var string E-mail
	 */
	public $email;

	/**
	 * @var string Message
	 */
	public $message;

	/**
	 * @var string Verification code
	 */
	public $verificationCode;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'name' => Yii::t('contacts', 'Name'),
			'phone' => Yii::t('contacts', 'Phone'),
			'email' => Yii::t('contacts', 'E-mail'),
			'message' => Yii::t('contacts', 'Message'),
			'verificationCode' => Yii::t('contacts', 'Verification code'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'message'], 'required'],
			['email', 'email'],
			['verificationCode', 'captcha'],
		];
	}

	public function contact($mailTo)
	{
		if (!$this->validate())
			return false;

		$message = Yii::$app->mailer->compose()
			->setTo($mailTo)
			->setSubject(Yii::t('contacts', 'New message'))
			->setHtmlBody(Yii::$app->controller->renderPartial('mail-contact', ['model' => $this]));

		if (!empty($this->email))
			$message->setReplyTo($this->email);

		return $message->send();
	}

}
