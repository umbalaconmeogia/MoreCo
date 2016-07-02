<?php

namespace app\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord
{

  /**
   * Get all errors on this model.
   * @param string $attribute attribute name. Use null to retrieve errors for all attributes.
   * @return array errors for all attributes or the specified attribute. Empty array is returned if no error.
   */
  public function getErrorMessages($attribute = NULL)
  {
    if ($attribute === NULL) {
      $attribute = $this->attributes();
    }
    if (!is_array($attribute)) {
      $attribute = array($attribute);
    }
    $errors = array();
    foreach ($attribute as $attr) {
      if ($this->hasErrors($attr)) {
        $errors = array_merge($errors, array_values($this->getErrors($attr)));
      }
    }
    return $errors;
  }
  
  /**
   * Log error of this model.
   * @param string $message
   */
  public function logError($message = NULL, $category='application')
  {
    if ($message) {
      Yii::error($message, $category);
    }
    Yii::error($this->tableName() . " " . print_r($this->attributes, TRUE), $category);
    Yii::error(print_r($this->getErrorMessages(), TRUE), $category);
  }

  /**
   * Create a hash of model list by a field value.
   * @param CActiveRecord $models
   * @param string $keyField Default by id.
   * @param string $valueField If specified, then this field's value is used. Else set the model instance as value.
   * @return array field $keyValue => ($value or model).
   */
  public static function hashModels($models, $keyField = 'id', $valueField = NULL) {
    $hash = array();
    foreach ($models as $model) {
      $hash[$model->$keyField] = $valueField ? $model->$valueField : $model;
    }
    return $hash;
  }
  
  public function __toString()
	{
	  return $this->toString($this->tableSchema->primaryKey);
	}

  /**
   * Create a string that describe all fields of this object.
   * @param mixed $fields String or string array. If NULL, all attributes are used.
   * @return string.
   */
  public function toString($fields = NULL)
  {
    if ($fields === NULL) {
      $fields = array_keys($this->attributes);
    }
    if (!is_array($fields)) {
      $fields = array($fields);
    }
    foreach ($fields as $field) {
      $info[] = "$field: {$this->$field}";
    }
    return get_class($this) . '(' . join(', ', $info) . ')';
  }
}
