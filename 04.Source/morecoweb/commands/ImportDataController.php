<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\HBackup;
use app\models\DictSentence;
use app\models\DictSentenceTranslation;
use app\models\DictLanguage;

/**
 * Backup to or import data from CSV file.
 */
class ImportDataController extends Controller
{
  public $inputCsv;
  public $truncate = 1;
  
  /**
   * {@inheritDoc}
   * @see \yii\console\Controller::options()
   */
  public function options($actionID)
  {
    return ['inputCsv', 'truncate'];
  }
  
  /**
   * Parameter:
   *   inputCsv
   *   truncate
   */
  public function actionImportFromCsv()
  {
		$this->inputCsv = explode(',', $this->inputCsv);
		foreach ($this->inputCsv as $csv) {
			HBackup::importDbFromCsv($csv, $this->truncate);
		}
  }
  
  public function actionImportDictData()
  {
    $transaction = Yii::$app->db->beginTransaction(); // Open transaction.
    try {
      // Truncate tables.
      HBackup::truncate([DictSentence::tableName(), DictSentenceTranslation::tableName()]);
      // Hash DictSentences by code => id.
      $languageCodeId = DictLanguage::hashModels(DictLanguage::findAllNotDeleted(), 'code', 'id');

      $handle = fopen($this->inputCsv, 'r'); // Open input csv.
      // Read header (language).
      $indexLanguageCodes = fgetcsv($handle);
      
      // Read and process data.
      while (($data = fgetcsv($handle)) !== FALSE) {
        // Add DictSentence
        $dictSentence = new DictSentence();
        $dictSentence->save();
        // Add DictSentenceTranslations.
        foreach ($data as $index => $text) {
          $languageCode = $indexLanguageCodes[$index];
          $dictSentenceTranslation = new DictSentenceTranslation([
              'dict_language_id' => $languageCodeId[$languageCode],
              'dict_sentence_id' => $dictSentence->id,
              'translated_sentence' => $text,
          ]);
          $dictSentenceTranslation->save();
        }
      }
      
      fclose($handle); // Close input csv.
      $transaction->commit(); // Commit transaction.
    } catch (Exception $e) {
      $transaction->rollback(); // Rolback transaction.
      throw $e;
    }
      
  }
}
