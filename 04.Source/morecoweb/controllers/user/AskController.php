<?php
namespace app\controllers\user;

use yii\web\Controller;

class AskController extends Controller
{
  public function actionIndex() {
    return $this->render('index');
  }
  
  public function actionAsk() {
    return $this->render('index');
  }
  
  public function actionListAll() {
    return $this->render('listAll');
  }
}