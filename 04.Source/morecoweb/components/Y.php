<?php
namespace app\components;

use Yii;

class Y {
  /**
   * Wrapper of Yii::t()
   * @param string $message
   * @param array $params
   * @param string $category
   */
  public static function t($message, $params = [], $category = 'app') {
    return Yii::t($category, $message, $params);
  }
}