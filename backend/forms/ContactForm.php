<?php

namespace cms\contact\backend\forms;

use Yii;
use yii\base\Model;
use cms\contact\common\models\Contact;

/**
 * Contact editing form
 */
class ContactForm extends Model
{

    /**
     * @var boolean Active
     */
    public $active;

    /**
     * @var string Title
     */
    public $title;

    /**
     * @var string Address
     */
    public $address;

    /**
     * @var float Geocode latitude
     */
    public $latitude;

    /**
     * @var float Geocode longitude
     */
    public $longitude;

    /**
     * @var PhoneForm[] Phones
     */
    private $_phones = [];

    /**
     * @var EmailForm[] E-mails
     */
    private $_emails = [];

    /**
     * @var Contact
     */
    private $_object;

    /**
     * @inheritdoc
     * @param Contact|null $object 
     */
    public function __construct(Contact $object = null, $config = [])
    {
        if ($object === null) {
            $object = new ContactForm;
        }

        $this->_object = $object;

        //attributes
        parent::__construct(array_replace([
            'active' => $object->active == 0 ? '0' : '1',
            'title' => $object->title,
            'address' => $object->address,
            'latitude' => $object->latitude,
            'longitude' => $object->longitude,
            'phones' => $object->getPhones(),
            'emails' => $object->getEmails(),
        ], $config));
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['phones', 'emails']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'active' => Yii::t('contact', 'Active'),
            'title' => Yii::t('contact', 'Title'),
            'address' => Yii::t('contact', 'Address'),
            'phones' => Yii::t('contact', 'Phones'),
            'emails' => Yii::t('contact', 'E-mails'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['active', 'boolean'],
            ['title', 'string', 'max' => 100],
            ['address', 'string', 'max' => 200],
            ['latitude', 'double', 'min' => -90, 'max' => 90],
            ['longitude', 'double', 'min' => -180, 'max' => 180],
            ['phones', function ($attribute, $params) {
                $hasError = false;
                foreach ($this->_phones as $model) {
                    if (!$model->validate()) {
                        $hasError = true;
                    }
                }

                if ($hasError) {
                    $this->addError($attribute . '[]', 'Phones validation error.');
                }
            }],
            ['emails', function ($attribute, $params) {
                $hasError = false;
                foreach ($this->_emails as $model) {
                    if (!$model->validate()) {
                        $hasError = true;
                    }
                }

                if ($hasError) {
                    $this->addError($attribute . '[]', 'E-mails validation error.');
                }
            }],
        ];
    }

    /**
     * Phones getter
     * @return PhoneForm[]
     */
    public function getPhones()
    {
        return $this->_phones;
    }

    /**
     * Phones setter
     * @param PhoneForm[]|array[] $value Phones
     * @return void
     */
    public function setPhones($value)
    {
        $this->_phones = [];

        if (!is_array($value)) {
            return;
        }

        foreach ($value as $item) {
            if ($item instanceof PhoneForm) {
                $this->_phones[] = $item;
            } elseif (is_array($item)) {
                $this->_phones[] = new PhoneForm($item);
            } else {
                Yii::warning('Failed to set `phone` ' . serialize($item));
            }
        }
    }

    /**
     * E-mails getter
     * @return EmailForm[]
     */
    public function getEmails()
    {
        return $this->_emails;
    }

    /**
     * E-mails setter
     * @param EmailForm[]|array[] $value E-mails
     * @return void
     */
    public function setEmails($value)
    {
        $this->_emails = [];

        if (!is_array($value)) {
            return;
        }

        foreach ($value as $item) {
            if ($item instanceof EmailForm) {
                $this->_emails[] = $item;
            } elseif (is_array($item)) {
                $this->_emails[] = new EmailForm($item);
            } else {
                Yii::warning('Failed to set `e-mail` ' . serialize($item));
            }
        }
    }

    /**
     * Saving object using model attributes
     * @return boolean
     */
    public function save($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            return false;
        }

        $object = $this->_object;

        $object->active = $this->active == 1;
        $object->title = $this->title;
        $object->address = $this->address;
        $object->latitude = empty($this->latitude) ? null : (float) $this->latitude;
        $object->longitude = empty($this->longitude) ? null : (float) $this->longitude;

        $object->setPhones(array_map(function($v) {
            return $v->getAttributes();
        }, $this->phones));
        $object->setEmails(array_map(function($v) {
            return $v->getAttributes();
        }, $this->emails));

        if (!$object->save(false)) {
            return false;
        }

        return true;
    }

}
