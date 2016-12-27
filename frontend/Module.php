<?php

namespace cms\contact\frontend;

use Yii;

/**
 * Contacts frontend module
 */
class Module extends \yii\base\Module
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
	public function init()
	{
		parent::init();

		if (!isset(Yii::$app->i18n->translations['contact'])) {
			Yii::$app->i18n->translations['contact'] = [
				'class' => 'yii\i18n\PhpMessageSource',
				'sourceLanguage' => 'en-US',
				'basePath' => dirname(__DIR__) . '/messages',
			];
		}
	}

}
