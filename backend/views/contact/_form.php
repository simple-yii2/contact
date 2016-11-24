<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\Html;

use simple\contacts\backend\assets\ContactAsset;
use simple\contacts\backend\models\PhoneForm;
use simple\contacts\backend\models\EmailForm;

?>
<?php $form = ActiveForm::begin([
	'layout' => 'horizontal',
	'enableClientValidation' => false,
]); ?>

	<?= $form->field($model, 'active')->checkbox() ?>

	<?= $form->field($model, 'title') ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

	<?= $form->field($model, 'address') ?>

	<?= $form->field($model, 'phones')->widget('dkhlystov\grid\ArrayInput', [
		'itemClass' => PhoneForm::className(),
		'columns' => ['number', 'description'],
		'addLabel' => Yii::t('contacts', 'Add'),
		'removeLabel' => Yii::t('contacts', 'Remove'),
	]) ?>

	<?= $form->field($model, 'emails')->widget('dkhlystov\grid\ArrayInput', [
		'itemClass' => EmailForm::className(),
		'columns' => ['email', 'description'],
		'addLabel' => Yii::t('contacts', 'Add'),
		'removeLabel' => Yii::t('contacts', 'Remove'),
	]) ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-6">
			<?= Html::submitButton(Yii::t('contacts', 'Save'), ['class' => 'btn btn-primary']) ?>
			<?= Html::a(Yii::t('contacts', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>
