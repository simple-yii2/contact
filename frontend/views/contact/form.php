<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$options = [
	'class' => 'col-md-6',
];

?>
<?php $form = ActiveForm::begin([
	'layout' => 'horizontal',
	'enableClientValidation' => false,
	'options' => $options,
	'fieldConfig' => [
		'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
		'horizontalCssClasses' => [
			'offset' => '',
			'label' => '',
			'wrapper' => 'col-sm-9'
		],
	],
]); ?>

	<?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>

	<?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')]) ?>

	<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

	<?= $form->field($model, 'message')->textarea(['rows' => 5, 'placeholder' => $model->getAttributeLabel('message')]) ?>

	<?= $form->field($model, 'verificationCode')->widget(Captcha::classname(), [
		'captchaAction' => '/site/captcha',
		'imageOptions' => ['class' => 'captcha-image'],
		'options' => [
			'class' => 'form-control captcha-input',
			'autocomplete' => 'off',
			'placeholder' => $model->getAttributeLabel('verificationCode'),
		],
	]); ?>

	<div class="form-group">
		<div class="col-sm-9">
			<?= Html::submitButton(Yii::t('contact', 'Send message'), ['class' => 'btn btn-default']) ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>