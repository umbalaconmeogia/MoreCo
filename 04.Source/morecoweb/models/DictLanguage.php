<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_language".
 *
 * @property integer $id
 * @property string $code
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class DictLanguage extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'string'],
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
            'code' => 'Code',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
    
    /**
     * Get all DictLanguageName(s) of this language.
     * @return DictLanguageName[]
     */
    public function getDictLanguageNames()
    {
      return $this->hasMany(DictLanguageName::className(), ['dict_language_id' => 'id']);
    }
    
    /**
     * Get DictLanguageName of this language in specified language.
     * @param int $inLanguageId Specified language.
     * @return string;
     */
    public function getDictLanguageNameStr($inLanguageId) {
      $dictLanguageNames = DictLanguageName::hashModels($this->getDictLanguageNames(), 'in_language_id');
      return isset($dictLanguageNames[$inLanguageId]) ? $dictLanguageNames[$inLanguageId]->name : $this->code;
    }
    
    /**
     * 
     * @param int $inLanguageId Specified language.
     * @return DictLanguageName[] Array mapping DictLanguage.id and name.
     */
    public static function getAllDictLanguageIdNameArray($inLanguageId) {
      // Create hash id => DictLanguage
      $dictLanguageHash = DictLanguage::hashModels(DictLanguage::findAllNotDeleted());
      // Get DictLanguage ID array (used for searching).
      $dictLanguageIds = array_keys($dictLanguageHash);
      // Get all DictLanguageName of specified DictLanguage IDs in language($inLanguageId).
      $dictLanguageNames = DictLanguageName::findAll(['dict_language_id' => $dictLanguageIds,
          'in_language_id' => $inLanguageId]);
      // Hash DictLanguageName by DictLanguage ID.
      $dictLanguageNameHash = DictLanguageName::hashModels($dictLanguageNames, 'dict_language_id');
      // Create result.
      $dictLanguageIdNames = [];
      foreach ($dictLanguageHash as $id => $dictLanguage) {
        $dictLanguageIdNames[$id] = isset($dictLanguageNameHash[$id]) ?
            $dictLanguageNameHash[$id]->name : $dictLanguage->code;
      }
      return $dictLanguageIdNames;
    }
}
