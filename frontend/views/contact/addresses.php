<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;
use simple\contacts\frontend\assets\AddressesGoogleAsset;
use simple\contacts\frontend\assets\AddressesYandexAsset;

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

$options = [
	'class' => 'col-md-6',
];

if ($isFormEmpty)
	$options['class'] = 'col-md-12';


$dataProvider = new ArrayDataProvider([
	'allModels' => $contacts,
	'pagination' => false,
]);

?>
<?= Html::beginTag('div', $options) ?>

	<?= Html::tag('div', '', ['class' => 'contact-map hidden']) ?>

	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'layout' => '{items}',
		'itemView' => '_address',
	]) ?>

<?= Html::endTag('div') ?>