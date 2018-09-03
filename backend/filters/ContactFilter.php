<?php

namespace cms\contact\backend\filters;

use Yii;
use yii\data\ActiveDataProvider;
use cms\contact\common\models\Contact;

/**
 * Contact filter
 */
class ContactFilter extends Contact
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('contact', 'Title'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'string'],
        ];
    }

    /**
     * Search function
     * @param array|null $config Data provider config
     * @return ActiveDataProvider
     */
    public function getDataProvider($config = [])
    {
        $query = self::find();
        $query->andFilterWhere(['like', 'title', $this->title]);

        $config['query'] = $query;
        return new ActiveDataProvider($config);
    }

}
