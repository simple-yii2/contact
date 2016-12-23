<?php

namespace cms\contact\backend\models;

use Yii;
use yii\data\ActiveDataProvider;

use cms\contact\common\models\Contact;

/**
 * Contact search model
 */
class ContactSearch extends Contact {

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
	 * Search rules
	 * @return array
	 */
	public function rules() {
		return [
			['title', 'string'],
		];
	}

	/**
	 * Search function
	 * @param array $params Attributes array
	 * @return yii\data\ActiveDataProvider
	 */
	public function search($params) {
		//ActiveQuery
		$query = static::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		//return data provider if no search
		if (!($this->load($params) && $this->validate()))
			return $dataProvider;

		//search
		$query->andFilterWhere(['like', 'title', $this->title]);

		return $dataProvider;
	}

}
