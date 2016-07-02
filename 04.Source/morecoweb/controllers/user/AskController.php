<?php
namespace app\controllers\user;

use app\models\Ask;
use Yii;
use app\components\BaseController;

class AskController extends BaseController
{
  
  public function actionNew() {
    $ask = new Ask();
    $ask->from_language_id = $this->getUserLaguageId();
    return $this->render('new', ['ask' => $ask]);
  }
  
  public function actionAsk() {
    $ask = new Ask();
    $ask->from_language_id = $this->getUserLaguageId();
    $ask->load(\Yii::$app->request->post());
    $ask->ask_user_id = $this->getUserId();
    
    if ($ask->validate() && $ask->save()) {
      $this->redirect(['list-my-asks']);
    } else {
      return $this->render('new', ['ask' => $ask]);
    }
  }

  public function actionListMyAsks() {
    $query = Ask::find()->orderBy('update_time DESC, create_time DESC')->where(['ask_user_id' => $this->getUserId()]);
    return $this->render('listAll', ['query' => $query]);
  }
  
  public function actionListAll() {
    $query = Ask::find()->orderBy('update_time DESC, create_time DESC');
    return $this->render('listAll', ['query' => $query]);
  }
}