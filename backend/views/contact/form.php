<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

use cms\contact\backend\assets\ContactAsset;
use cms\contact\backend\models\PhoneForm;
use cms\contact\backend\models\EmailForm;

use dkhlystov\widgets\AddressInput;

$config = [
	'latitudeAttribute' => 'latitude',
	'longitudeAttribute' => 'longitude',
	'searchLabel' => Yii::t('contact', 'Find on map'),
	'removeLabel' => Yii::t('contact', 'Remove marker'),
];

foreach (Yii::$app->modules as $v) {
	if (is_string($v)) {
		$name = $v;
	} elseif (is_array($v)) {
		$name = $v['class'];
	} else {
		$name = $v::className();
	}
	if ($name == 'cms\contact\frontend\Module') {
		if (is_array($v)) {
			if (isset($v['mapType']))
				$config['type'] = $v['mapType'];
			if (isset($v['mapKey']))
				$config['key'] = $v['mapKey'];
		} elseif (!is_string($v)) {
			$config['type'] = $v->mapType;
			$config['key'] = $v->key;
		}
		break;
	}
}


?>
<?php $form = ActiveForm::begin([
	'layout' => 'horizontal',
	'enableClientValidation' => false,
]); ?>

	<?= $form->field($model, 'active')->checkbox() ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'address')->widget(AddressInput::className(), $config) ?>

	<?= $form->field($model, 'phones')->widget('dkhlystov\grid\ArrayInput', [
		'itemClass' => PhoneForm::className(),
		'columns' => ['description', 'number'],
		'addLabel' => Yii::t('contact', 'Add'),
		'removeLabel' => Yii::t('contact', 'Remove'),
	]) ?>

	<?= $form->field($model, 'emails')->widget('dkhlystov\grid\ArrayInput', [
		'itemClass' => EmailForm::className(),
		'columns' => ['description', 'email'],
		'addLabel' => Yii::t('contact', 'Add'),
		'removeLabel' => Yii::t('contact', 'Remove'),
	]) ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-6">
			<?= Html::submitButton(Yii::t('contact', 'Save'), ['class' => 'btn btn-primary']) ?>
			<?= Html::a(Yii::t('contact', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>
