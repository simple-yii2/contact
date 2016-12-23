<?php

use yii\helpers\Html;

$title = Yii::t('contact', 'Contacts');

$this->title = $title . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'] = [
	$title,
];


$isAddressesEmpty = empty($contacts);
$isFormEmpty = !$renderForm;

?>
<h1><?= Html::encode($title) ?></h1>

<div class="row">
	<?php if (!$isAddressesEmpty) echo $this->render('addresses', [
		'isFormEmpty' => $isFormEmpty,
		'contacts' => $contacts,
	]) ?>

	<?php if (!$isFormEmpty) echo $this->render('form', [
		'isAddressesEmpty' => $isAddressesEmpty,
		'model' => $model,
	]) ?>
</div>


