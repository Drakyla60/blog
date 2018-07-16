<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/16/2018
 * Time: 2:19 PM
 */

namespace core\forms;


use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class CompositeForm extends Model
{
    /**
     * @var Model[]
     */
    private $forms = [];

    /**
     * @return array
     */
    abstract protected function internalForms(): array;
    
    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */public function load($data, $formName = null): bool
    {
        $success = parent::load($data,$formName);
        foreach ($this->forms as $name => $form) {
            $success = $form->load($data, $formName ? null : $name) && $success;
        }
        return $success;
    }
    
    /**
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */public function validate($attributeNames = null, $clearErrors = true): bool
    {
        $parentNames = array_filter($attributeNames, 'is_string');
        $success = parent::validate($parentNames, $clearErrors);
        foreach ($this->forms as $name => $form) {
            $innerNames = ArrayHelper::getValue($attributeNames, $name);
            $success = $form->validate($innerNames, $clearErrors) && $success;
        }
        return $success;
    }

    /**
     * @param string $name
     * @return mixed|Model
     * @throws \yii\base\UnknownPropertyException
     */public function __get($name)
    {
        if (isset($this->forms[$name])) {
            return $this->forms[$name];
        }
        return parent::__get($name);
    }

     /**
      * @param string $name
      * @param mixed $value
      * @throws \yii\base\UnknownPropertyException
      */public function __set($name, $value)
     {
         if (in_array($name, $this->internalForms(), true)) {
             $this->forms[$name] = $value;
         } else {
             parent::__set($name, $value);
         }
     }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->forms[$name]) || parent::__isset($name);
    }
}






