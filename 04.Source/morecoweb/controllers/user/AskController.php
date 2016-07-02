<?php
namespace app\controllers\user;

use yii\web\Controller;
use app\models\Ask;

class AskController extends Controller
{
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