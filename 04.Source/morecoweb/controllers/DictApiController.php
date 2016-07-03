<?php

namespace app\controllers;

use app\models\DictVersion;
use Yii;
use yii\web\Controller;
use app\models\DictLanguage;
use app\models\DictLanguageName;
use app\models\DictSentence;
use app\models\DictSentenceTranslation;

class DictApiController extends Controller {
  
  /**
   * Get current version of dict data.
   * @return \yii\db\ActiveRecord|NULL
   */
  public function actionVersion() {
    $dictVersion = DictVersion::find()->orderBy([ 
        'id' => SORT_DESC 
    ])->select([
        'id',
        'version' 
    ])->one();
    \Yii::$app->response->format = 'json';
    return $dictVersion;
  }
  
  /**
   * Return all dict data in JSON.
   */
  public function actionData() {
    // Get DictVersion.
    $dictVersion = DictVersion::find()->orderBy([ 
        'id' => SORT_DESC 
    ])->select([
        'id',
        'version' 
    ])->one();
    // Get DictLanguage list.
    $dictLanguages = DictLanguage::find()->select([ 
        'id',
        'code',
        'data_status' 
    ])->all();
    // Get DictLanguageName list.
    $dictLanguageNames = DictLanguageName::find()->select([ 
        'id',
        'dict_language_id',
        'in_language_id',
        'name',
        'data_status' 
    ])->all();
    // Get DictSentence list.
    $dictSentences = DictSentence::find()->select([ 
        'id',
        'data_status' 
    ])->all();
    // Get DictSentenceTranslation list.
    $dictSentenceTranslations = DictSentenceTranslation::find()->select([ 
        'id',
        'dict_language_id',
        'dict_sentence_id',
        'translated_sentence',
        'searching_text',
        'data_status' 
    ])->all();
    
//     // Limit return result. Just for test.
//     $maxDictSentenceNumber = Yii::$app->request->get('maxDictSentenceNumber');
//     if ($maxDictSentenceNumber) {
//       $dictSentences = array_slice($dictSentences, 0, $maxDictSentenceNumber);
//       $dictSentenceTranslations = array_slice(
//           $dictSentenceTranslations, 0, $maxDictSentenceNumber * count($dictLanguages));
//     }
    
    // Set return result.
    $result = [ 
        'DictVersion' => $dictVersion,
        'DictLanguages' => $dictLanguages,
        'DictLanguageNames' => $dictLanguageNames,
        'DictSentences' => $dictSentences,
        'DictSentenceTranslations' => $dictSentenceTranslations,
    ];
    \Yii::$app->response->format = 'json';
    return $result;
  }
}
