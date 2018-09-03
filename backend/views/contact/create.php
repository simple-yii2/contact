<?php

use yii\helpers\Html;

$title = Yii::t('contact', 'Create contact');

$this->title = $title . ' | ' . Yii::$app->name;

$this->params['breadcrumbs'] = [
    ['label' => Yii::t('contact', 'Contacts'), 'url' => ['index']],
    $title,
];

?>
<h1><?= Html::encode($title) ?></h1>

<?= $this->render('form', [
    'model' => $model,
]) ?>
