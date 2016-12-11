<?php

namespace simple\contacts\frontend\assets;

use yii\web\AssetBundle;

class AddressesGoogleAsset extends AssetBundle
{

	public $css = [
		'addresses.css',
	];

	public $js = [
		'addresses-google.js',
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
