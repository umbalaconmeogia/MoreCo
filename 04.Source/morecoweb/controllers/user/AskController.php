<?php
namespace app\controllers\user;

use yii\web\Controller;
use app\models\Ask;

class AskController extends Controller
{
  public function actionIndex() {
    return $this->render('index');
  }
  
  public function actionAsk() {
    $ask = new Ask();
    $ask->from_language_id = \Yii::$app->request->get('from_language_id', 1);
    return $this->render('ask', ['ask' => $ask]);
  }
  
  public function actionListAll() {
    return $this->render('listAll');
  }
}