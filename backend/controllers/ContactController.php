<?php

namespace cms\contact\backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use cms\contact\backend\forms\ContactForm;
use cms\contact\backend\filters\ContactFilter;
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
        $filter = new ContactFilter;
        $filter->load(Yii::$app->getRequest()->get());

        return $this->render('index', ['filter' => $filter]);
    }

    /**
     * Creating
     * @return void
     */
    public function actionCreate()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('cms', 'Changes saved successfully.'));
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
        if ($object === null) {
            throw new BadRequestHttpException(Yii::t('cms', 'Item not found.'));
        }

        $model = new ContactForm($object);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('cms', 'Changes saved successfully.'));
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
        if ($object === null) {
            throw new BadRequestHttpException(Yii::t('cms', 'Item not found.'));
        }

        if ($object->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('cms', 'Item deleted successfully.'));
        }

        return $this->redirect(['index']);
    }

}
