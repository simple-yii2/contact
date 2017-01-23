<?php

use yii\grid\GridView;
use yii\helpers\Html;

$title = Yii::t('contact', 'Contacts');

$this->title = $title . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'] = [
	$title,
];

?>
<h1><?= Html::encode($title) ?></h1>

<div class="btn-toolbar" role="toolbar">
	<?= Html::a(Yii::t('contact', 'Create'), ['create'], ['class' => 'btn btn-primary']) ?>
</div>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $model,
	'summary' => '',
	'tableOptions' => ['class' => 'table table-condensed'],
	'rowOptions' => function ($model, $key, $index, $grid) {
		return !$model->active ? ['class' => 'warning'] : [];
	},
	'columns' => [
		[
			'attribute' => 'title',
			'format' => 'html',
			'value' => function($model, $key, $index, $column) {
				$title = Html::encode($model->title);

				if (empty($title))
					$title = Html::encode($model->address);

				if (empty($title)) {
					$items = array_map(function($v) {
						return $v['number'];
					}, $model->getPhones());

					$title = Html::encode(implode(', ', $items));
				}

				if (empty($title)) {
					$items = array_map(function($v) {
						return $v['email'];
					}, $model->getEmails());

					$title = Html::encode(implode(', ', $items));
				}

				return $title;
			}
		],
		[
			'class' => 'yii\grid\ActionColumn',
			'options' => ['style' => 'width: 50px;'],
			'template' => '{update} {delete}',
		],
	],
]) ?>
