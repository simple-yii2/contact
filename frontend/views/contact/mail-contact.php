<?php

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<body>

	<div>
		<strong><?= Html::encode($model->getAttributeLabel('name')) ?></strong>
		<span><?= Html::encode($model->name) ?></span>
	</div>

	<div>
		<strong><?= Html::encode($model->getAttributeLabel('phone')) ?></strong>
		<span><?= Html::encode($model->phone) ?></span>
	</div>

	<div>
		<strong><?= Html::encode($model->getAttributeLabel('email')) ?></strong>
		<span><?= Html::encode($model->email) ?></span>
	</div>

	<div><?= Html::encode($model->message) ?></div>

</body>
</html>
