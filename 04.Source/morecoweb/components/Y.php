<?php
namespace app\components;

use Yii;

class Y {
  /**
   * Wrapper of Yii::t
   */
  public static function t($message, $category = 'app') {
    return Yii::t($category, $message);
  }
}