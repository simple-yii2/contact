<?php

namespace cms\contact\frontend\assets;

use yii\web\AssetBundle;

class AddressesYandexAsset extends AssetBundle
{

	public $css = [
		'addresses.css',
	];

	public $js = [
		'addresses-yandex.js',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];

	public function init()
	{
		parent::init();

		$this->sourcePath = __DIR__ . '/addresses';
	}

}
