<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Html;

use cms\contact\frontend\assets\AddressesGoogleAsset;
use cms\contact\frontend\assets\AddressesYandexAsset;

$title = Yii::t('contact', 'Contacts');

$this->title = $title . ' | ' . Yii::$app->name;

$module = Yii::$app->controller->module;
if ($module->mapType === $module::GOOGLE) {
	AddressesGoogleAsset::register($this);
	$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key={$module->mapKey}&callback=initContactAddressMap", [
		'depends' => [AddressesGoogleAsset::className()],
	]);
} else {
	AddressesYandexAsset::register($this);
	$lang = str_replace('-', '_', Yii::$app->language);
	$this->registerJsFile("https://api-maps.yandex.ru/2.1/?load=package.full&lang={$lang}", [
		'position' => \yii\web\View::POS_HEAD,
	]);
}

?>
<h1><?= Html::encode($title) ?></h1>

<div class="row">
	<div class="col-sm-12">
		<?= Html::tag('div', '', ['class' => 'contact-map hidden']) ?>
	</div>

	<?= $this->render('addresses', ['contacts' => $contacts]) ?>

	<?= $this->render('feedback') ?>
</div>
