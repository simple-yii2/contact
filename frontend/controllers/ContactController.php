<?php

namespace cms\contact\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use cms\contact\common\models\Contact;

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

		if (empty($contacts))
			throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

		return $this->render('index', [
			'contacts' => $contacts,
		]);
	}

}
