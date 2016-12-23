<?php

namespace cms\contact\backend\controllers;

use Yii;
// use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
// use yii\web\BadRequestHttpException;
use yii\web\Controller;

use cms\contact\backend\models\ContactForm;
use cms\contact\backend\models\ContactSearch;
use cms\contact\common\models\Contact;

class ContactController extends Controller
{

	/**
	 * Access control
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					['allow' => true, 'roles' => ['Contact']],
				],
			],
		];
	}

	/**
	 * List
	 * @return void
	 */
	public function actionIndex()
	{
		$model = new ContactSearch;

		return $this->render('index', [
			'dataProvider' => $model->search(Yii::$app->getRequest()->get()),
			'model' => $model,
		]);
	}

	/**
	 * Creating
	 * @return void
	 */
	public function actionCreate()
	{
		$model = new ContactForm(new Contact);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('contact', 'Changes saved successfully.'));
			return $this->redirect(['index']);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updating
	 * @param integer $id
	 * @return void
	 */
	public function actionUpdate($id)
	{
		$object = Contact::findOne($id);
		if ($object === null)
			throw new BadRequestHttpException(Yii::t('contact', 'Contact not found.'));

		$model = new ContactForm($object);

		if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', Yii::t('contact', 'Changes saved successfully.'));
			return $this->redirect(['index']);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deleting
	 * @param integer $id
	 * @return void
	 */
	public function actionDelete($id)
	{
		$object = Contact::findOne($id);
		if ($object === null)
			throw new BadRequestHttpException(Yii::t('contact', 'Contact not found.'));

		if ($object->delete()) {
			Yii::$app->session->setFlash('success', Yii::t('contact', 'Contact deleted successfully.'));
		}

		return $this->redirect(['index']);
	}

}
