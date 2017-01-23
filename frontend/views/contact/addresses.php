<?php

use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

$dataProvider = new ArrayDataProvider([
	'allModels' => $contacts,
	'pagination' => false,
]);

?>
<div class="col-md-6">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'layout' => '{items}',
		'itemView' => 'address',
	]) ?>
</div>
