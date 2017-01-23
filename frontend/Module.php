<?php

namespace cms\contact\frontend;

use Yii;

use cms\components\BaseModule;

/**
 * Contacts frontend module
 */
class Module extends BaseModule
{

	/**
	 * Map types
	 */
	const GOOGLE = 0;
	const YANDEX = 1;

	/**
	 * @var integer map type
	 */
	public $mapType = 1;

	/**
	 * @var string map key
	 */
	public $mapKey;

	/**
	 * @inheritdoc
	 */
	public static function moduleName()
	{
		return 'contact';
	}

}
