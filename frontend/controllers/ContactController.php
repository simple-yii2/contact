<?php

namespace cms\contact\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use cms\contact\common\models\Contact;
use cms\contact\frontend\models\ContactForm;

/**
 * Contacts frontend controller
 */
class ContactController extends Controller
{

	/**
	 * Show contacts
	 * @return void
	 */
	public function actionIndex()
	{
		$contacts = Contact::find()->andWhere(['active' => true])->all();
		$mailTo = $this->module->mailTo;

		if (empty($contacts) && $mailTo === null)
			throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

		$model = new ContactForm;

		if ($model->load(Yii::$app->getRequest()->post()) && $model->contact($this->module->mailTo)) {
			Yii::$app->session->setFlash('success', Yii::t('contact', 'Message send successfully.'));
			return $this->refresh();
		}

		return $this->render('index', [
			'model' => $model,
			'contacts' => $contacts,
			'renderForm' => $mailTo !== null,
		]);
	}

}
