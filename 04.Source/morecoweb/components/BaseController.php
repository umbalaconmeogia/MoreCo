<?php
namespace app\components;

use yii\web\Controller;
use Yii;
use app\models\DictLanguage;
use app\models\AppUser;

class BaseController extends Controller
{
  const SESSION_KEY_USER_LOGIN_ID = 'userLoginId';
  const SESSION_KEY_USER_LANGUAGE_ID = 'userLanguageId';
  const SESSION_KEY_USER_LANGUAGE_CODE = 'userLanguageCode';

  /**
   * Check if user specified.
   * {@inheritDoc}
   * @see \yii\web\Controller::beforeAction()
   */
  public function init()
  {
    parent::init();
    $this->checkUserEmail();
    $this->checkUserLanguage();
    //     return parent::beforeAction($event);
  }
  
  /**
   * Set user language.
   */
  private function checkUserLanguage() {
    // Set language code
    $userLanguageCode = Yii::$app->request->get('userLanguageCode');
    if ($userLanguageCode) {
      // Find DictLanguage
      $dictLanguage = DictLanguage::find()->where(['code' => $userLanguageCode])->one();
      if ($dictLanguage) {
        // Save into session.
        Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_ID] = $dictLanguage->id;
        Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_CODE] = $dictLanguage->code;
      }
    }
    // Check user language id.
    if (!isset(Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_ID])) {
      Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_ID] = 1;
      Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_CODE] = 'en';
    }
    // Set system language.
    Yii::$app->language = Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_CODE];
  }
  
  /**
   * Set login user email.
   * @throws \Exception
   */
  private function checkUserEmail() {
    // Set user email.
    $userLoginEmail = Yii::$app->request->get('userLoginEmail');
    if ($userLoginEmail) {
      // Find AppUser
      $appUser = AppUser::find()->where(['email' => $userLoginEmail])->one();
      if ($appUser == null) {
        $appUser = new AppUser([
            'account' => $userLoginEmail,
            'email' => $userLoginEmail,
        ]);
        if (!$appUser->save()) {
          throw new \Exception("Invalid saving " . $appUser);
        }
      }
      // Save into session.
      Yii::$app->session[self::SESSION_KEY_USER_LOGIN_ID] = $appUser->id;
    }
  
    // Check user id.
    if (!isset(Yii::$app->session[self::SESSION_KEY_USER_LOGIN_ID])) {
      throw new \Exception("You are not login");
    }
  }
  
  /**
   * Get user language id in session.
   */
  public static function getUserLaguageId() {
    return Yii::$app->session[self::SESSION_KEY_USER_LANGUAGE_ID];
  }
  
  public static function getUserId() {
    return Yii::$app->session[self::SESSION_KEY_USER_LOGIN_ID];
  }
}