<?php

use yii\helpers\Html;

$title = Yii::t('contacts', 'Create contact');

$this->title = $title . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'] = [
	['label' => Yii::t('contacts', 'Contacts'), 'url' => ['index']],
	$title,
];

?>
<h1><?= Html::encode($title) ?></h1>

<?= $this->render('_form', [
	'model' => $model,
]) ?>
