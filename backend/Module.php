<?php

namespace cms\contact\backend;

use Yii;
use cms\components\BackendModule;

/**
 * Contacts backend module
 */
class Module extends BackendModule
{

    /**
     * @inheritdoc
     */
    protected static function cmsSecurity()
    {
        $auth = Yii::$app->getAuthManager();
        if ($auth->getRole('Contact') === null) {
            //role
            $role = $auth->createRole('Contact');
            $auth->add($role);
        }
    }

    /**
     * @inheritdoc
     */
    public function cmsMenu()
    {
        if (!Yii::$app->user->can('Contacts')) {
            return [];
        }

        return [
            'label' => Yii::t('contact', 'Contacts'),
            'url' => ['/contact/contact/index'],
        ];
    }

}
