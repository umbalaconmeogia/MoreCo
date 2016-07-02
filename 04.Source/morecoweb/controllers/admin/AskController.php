<?php

namespace app\controllers\admin;

use yii\web\Controller;
use Yii;
use app\models\Ask;
use app\models\DictSentenceTranslation;
use app\models\DictSentence;

class AskController extends Controller
{
	/**
	 * List ask
	 * 
	 * @return Ambigous <string, string>
	 */
	public function actionList() {
        return $this->render('list');
    }

    /**
     * Edit & view ask
     * 
     * @return $return
     */
    public function actionEdit() {
    	
    	$return = array();
    	$id = Yii::$app->request->get('id');
        $ask = Ask::find()->where(['id' => $id])->one();
        
        $fromDictSentenceTrans = new DictSentenceTranslation();
        $fromDictSentenceTrans->dict_language_id = $ask->from_language_id;
        $toDictSentenceTrans = new DictSentenceTranslation();
        $toDictSentenceTrans->dict_language_id = $ask->to_language_id;
        
    	if ($ask->answer_status == Ask::ANSWER_STATUS_CLOSED) {
    		$return = $this->render('view',['ask' => $ask]);
    	} else {
    		$return = $this->render('edit',[
    				'ask' => $ask,
    				'fromDictSentenceTrans' => $fromDictSentenceTrans,
    				'toDictSentenceTrans' => $toDictSentenceTrans,
    		]);
    	}
    	return $return;
    }
    
    private function parseDictSentenceTrans($urlPram) {
    	$model = new DictSentenceTranslation();
    	$model->attributes = $urlPram;
    	return $model;
    }
    
    public function actionAnswerAsk() {
    	$id = Yii::$app->request->get('id');
    	$ask = Ask::find()->where(['id' => $id])->one();
    	$dictSentenceTrans = Yii::$app->request->post('DictSentenceTranslation');
    	$fromDictSentenceTrans = $this->parseDictSentenceTrans($dictSentenceTrans[0]);
    	$toDictSentenceTrans = $this->parseDictSentenceTrans($dictSentenceTrans[1]);

    	// Set dummy dict_sectence_id.
    	$fromDictSentenceTrans->dict_sentence_id = -1;
    	$toDictSentenceTrans->dict_sentence_id = -1;
    	
    	$validate = $fromDictSentenceTrans->validate() && $toDictSentenceTrans->validate();

    	// Reset dict_sectence_id.
    	$fromDictSentenceTrans->dict_sentence_id = null;
    	$toDictSentenceTrans->dict_sentence_id = null;
    	 
    	if ($validate) {
	    	$dictSentence = new DictSentence();
	    	$dictSentence->save();
	    	
	    	$ask->answer_dict_sentence_id = $dictSentence->id;
	    	$ask->answer_status = Ask::ANSWER_STATUS_CLOSED;
	    	$ask->save();
	    	
	    	$fromDictSentenceTrans->dict_sentence_id = $dictSentence->id;
	    	$fromDictSentenceTrans->save();
	    	
	    	$toDictSentenceTrans->dict_sentence_id = $dictSentence->id;
	    	$toDictSentenceTrans->save();
	    	
	    	$this->redirect(['list']);
    	} else {
    		return $this->render('edit', [
    				'ask' => $ask,
    				'fromDictSentenceTrans' => $fromDictSentenceTrans,
    				'toDictSentenceTrans' => $toDictSentenceTrans,
    	]);
    	}
    }
}
