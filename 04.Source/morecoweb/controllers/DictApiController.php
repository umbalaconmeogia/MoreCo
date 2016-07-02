<?php

namespace app\controllers;

use app\models\DictVersion;
use Yii;
use yii\web\Controller;
use app\models\DictLanguage;
use app\models\DictLanguageName;
use app\models\DictSentence;
use app\models\DictSentenceTranslation;

class DictApiController extends Controller
{
    public function actionVersion()
    {
        $dictVersion = DictVersion::find()->orderBy(['id' => SORT_DESC])->select(['id', 'version'])->one();
        \Yii::$app->response->format = 'json';
        return $dictVersion;
    }

    public function actionData()
    {
        $dictVersion = DictVersion::find()->orderBy(['id' => SORT_DESC])->select(['id', 'version'])->one();
        $dictLanguages = DictLanguage::find()->select(['id', 'code', 'data_status'])->all();
        $dictLanguageNames = DictLanguageName::find()->select(
                ['id', 'dict_language_id', 'in_language_id', 'name', 'data_status'])->all();
        $dictSentences = DictSentence::find()->select(['id', 'data_status'])->all();
        $dictSentenceTranslations = DictSentenceTranslation::find()->select(
                ['id', 'dict_language_id', 'dict_sentence_id', 'translated_sentence', 'searching_text', 'data_status'])->all();
        $result = [
            'DictVersion' => $dictVersion,
            'DictLanguage' => $dictLanguages,
            'DictLanguageNames' => $dictLanguageNames,
            'DictSentences' => $dictSentences,
            'DictSentenceTranslations' => $dictSentenceTranslations,
        ];
        \Yii::$app->response->format = 'json';
        return $result;
    }
}
