<?php

use yii\helpers\Html;

$title = Html::tag('strong', Html::encode($model->title));

$phones = '';
foreach ($model->getPhones() as $phone) {
	$d = '';
	if (!empty($phone['description']))
		$d = Html::tag('span', Html::encode($phone['description']) . ': ');

	$n = Html::a(Html::encode($phone['number']), 'tel:' . $phone['number']);

	$phones .= Html::tag('div', $d . $n);
}

$emails = '';
foreach ($model->getEmails() as $email) {
	$d = '';
	if (!empty($email['description']))
		$d = Html::tag('span', Html::encode($email['description']) . ': ');

	$e = Html::a(Html::encode($email['email']), 'mailto:' . $email['email']);

	$emails .= Html::tag('div', $d . $e);
}

$options = ['class' => 'contact-wrapper'];

if (!empty($model->latitude) && !empty($model->longitude)) {
	$options['data-lat'] = $model->latitude;
	$options['data-lng'] = $model->longitude;
}

$address = '';
if (!empty($model->address)) {
	$address = Html::encode($model->address);
	if (!empty($model->latitude) && !empty($model->longitude))
		$address = Html::a($address, '#', ['class' => 'contact-address']);

	$address = Html::tag('div', $address);
}

?>
<?= Html::tag('div', $title . $address . $phones . $emails, $options) ?>
