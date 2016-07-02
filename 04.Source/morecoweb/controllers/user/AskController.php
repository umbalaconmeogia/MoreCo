<?php
namespace app\controllers\user;

use yii\web\Controller;
use app\models\Ask;
use app\models\AppUser;
use Yii;
use app\models\DictLanguage;

class AskController extends Controller
{
  /**
   * Check if user specified.
   * {@inheritDoc}
   * @see \yii\web\Controller::beforeAction()
   */
  public function beforeAction($event)
  {
    $this->checkUserEmail();
    $this->checkUserLanguage();

    return parent::beforeAction($event);
  }
  
  public function actionNew() {
    $ask = new Ask();
    $ask->from_language_id = \Yii::$app->request->get('from_language_id', 1);
    return $this->render('new', ['ask' => $ask]);
  }
  
  public function actionAsk() {
    $ask = new Ask();
    $ask->load(\Yii::$app->request->post());
    
    if ($ask->save()) {
      $this->redirect(['list-my-asks']);
    } else {
      return $this->render('new', ['ask' => $ask]);
    }
  }

  public function actionListMyAsks() {
    $query = Ask::find();
    return $this->render('listAll', ['query' => $query]);
  }
  
  public function actionListAll() {
    $query = Ask::find();
    return $this->render('listAll', ['query' => $query]);
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
        Yii::$app->session['userLanguageId'] = $dictLanguage->id;
      }
    }
    // Check user language id.
    if (!isset(Yii::$app->session['userLanguageId'])) {
      Yii::$app->session['userLanguageId'] = 1;
    }
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
      Yii::$app->session['userLoginId'] = $appUser->id;
    }
    
    // Check user id.
    if (!isset(Yii::$app->session['userLoginId'])) {
      throw new \Exception("You are not login");
    }
  }
}