<?php
namespace app\controllers\user;

use yii\web\Controller;
use app\models\Ask;
use app\models\AppUser;
use Yii;

class AskController extends Controller
{
  /**
   * Check if user specified.
   * {@inheritDoc}
   * @see \yii\web\Controller::beforeAction()
   */
  public function beforeAction($event)
  {
    // Set user.
    $loginUserEmail = Yii::$app->request->get('loginUserEmail');
    if ($loginUserEmail) {
      // Find AppUser
      $appUser = AppUser::find()->where(['email' => $loginUserEmail])->one();
      if ($appUser == null) {
        $appUser = new AppUser([
            'account' => $loginUserEmail,
            'email' => $loginUserEmail,
        ]);
        if (!$appUser->save()) {
          throw new \Exception("Invalid saving " . $appUser);
        }
      }
      Yii::$app->session['userId'] = $appUser->id;
    }
    
    // Check user id.
    if (!isset(Yii::$app->session['userId'])) {
      throw new \Exception("You are not login");
    }
    
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
}