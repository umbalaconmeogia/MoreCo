<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_sentence".
 *
 * @property integer $id
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class DictSentence extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_sentence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_status', 'create_user_id', 'update_user_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
    
    public function getDictSentenceTranslations() {
      return $this->hasMany(DictSentenceTranslation::className(), ['dict_sentence_id' => 'id']);
    }
    
    /**
     * @param int $languageId
     * @return DictSentenceTranslation
     */
    public function getDictSentenceTranslation($languageId) {
      $transHashLanguage = DictSentenceTranslation::hashModels($this->dictSentenceTranslations, 'dict_language_id');
      $result = isset($transHashLanguage[$languageId]) ?
          $transHashLanguage[$languageId] : array_values($transHashLanguage)[0]; 
      return $result;
    }
}
