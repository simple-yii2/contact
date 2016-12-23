<?php

namespace cms\contact\frontend\models;

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
			'name' => Yii::t('contact', 'Name'),
			'phone' => Yii::t('contact', 'Phone'),
			'email' => Yii::t('contact', 'E-mail'),
			'message' => Yii::t('contact', 'Message'),
			'verificationCode' => Yii::t('contact', 'Verification code'),
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
			->setSubject(Yii::t('contact', 'New message'))
			->setHtmlBody(Yii::$app->controller->renderPartial('mail-contact', ['model' => $this]));

		if (!empty($this->email))
			$message->setReplyTo($this->email);

		return $message->send();
	}

}
