<?php

namespace app\models;

use Yii;
use app\components\Y;

/**
 * This is the model class for table "ask".
 *
 * @property integer $id
 * @property integer $from_language_id
 * @property integer $to_language_id
 * @property string $ask_content
 * @property integer $ask_user_id
 * @property integer $answer_status
 * @property integer $answer_dict_sentence_id
 * @property string $answer_dict_sentence_param
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Ask extends BaseBatsgModel
{
	/*
	 * answer_status constant
	 */
	const ANSWER_STATUS_NOT_ANSWERED = 0;
	const ANSWER_STATUS_ANSWERED = 1;
	const ANSWER_STATUS_CLOSED = 2;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ask';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_language_id', 'to_language_id', 'ask_content'], 'required'],
            [['from_language_id', 'to_language_id', 'ask_user_id', 'answer_status', 'answer_dict_sentence_id', 'data_status', 'create_user_id', 'update_user_id'], 'integer'],
            [['ask_content', 'answer_dict_sentence_param'], 'string'],
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
            'from_language_id' => 'From Language ID',
            'to_language_id' => 'To Language ID',
            'ask_content' => 'Ask Content',
            'ask_user_id' => 'Ask User ID',
            'answer_status' => 'Answer Status',
            'answer_dict_sentence_id' => 'Answer Dict Sentence ID',
            'answer_dict_sentence_param' => 'Answer Dict Sentence Param',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }

    /**
     * @return DictLanguage
     */
    public function getFromLanguage() {
      return $this->hasOne(DictLanguage::className(), ['id' => 'from_language_id']);
    }
    
    /**
     * Get name of from language in specified language.
     * @param int $inLanguageId Specified language.
     * @return string
     */
    public function getFromLanguageStr($inLanguageId) {
      return $this->fromLanguage->getDictLanguageNameStr($inLanguageId);
    }

    /**
     * @return DictLanguage
     */
    public function getToLanguage() {
      return $this->hasOne(DictLanguage::className(), ['id' => 'to_language_id']);
    }
    
    /**
     * Get name of to language in specified language.
     * @param int $inLanguageId Specified language.
     * @return string
     */
    public function getToLanguageStr($inLanguageId) {
      return $this->toLanguage->getDictLanguageNameStr($inLanguageId);
    }
    
    /**
     * getToLanguageNames
     */
//     public function getToLanguageNames()
//     {
//     	return $this->hasMany(DictLanguageName::className(), ['to_language_id' => 'id']);
//     }
    
    /**
     * getAnswerStatusStr
     * 
     * @return $statusStrs
     */
    public function getAnswerStatusStr() {
    	$statusStrs = [
    	self::ANSWER_STATUS_NOT_ANSWERED => Y::t('Not answered'),
    	self::ANSWER_STATUS_ANSWERED => Y::t('Answered'),
    	self::ANSWER_STATUS_CLOSED => Y::t('Closed'),
    	];
    	return isset($statusStrs[$this->answer_status]) ? $statusStrs[$this->answer_status] : Y::t('Unknown');
    }
}
