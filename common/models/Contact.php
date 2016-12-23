<?php

namespace cms\contact\common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Contact active record
 */
class Contact extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'Contact';
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->active = true;
	}

	/**
	 * Phones getter
	 * @return array
	 */
	public function getPhones()
	{
		$result = unserialize($this->phones);
		
		if (!is_array($result))
			$result = [];

		return $result;
	}

	/**
	 * Phones setter
	 * @param array $value 
	 * @return void
	 */
	public function setPhones($value)
	{
		$this->phones = serialize($value);
	}

	/**
	 * E-mails getter
	 * @return array
	 */
	public function getEmails()
	{
		$result = unserialize($this->emails);

		if (!is_array($result))
			$result = [];

		return $result;
	}

	/**
	 * E-mails setter
	 * @param array $value 
	 * @return void
	 */
	public function setEmails($value)
	{
		$this->emails = serialize($value);
	}

}
