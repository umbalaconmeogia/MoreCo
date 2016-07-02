<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_sentence_translation".
 *
 * @property integer $id
 * @property integer $dict_language_id
 * @property integer $dict_sentence_id
 * @property string $translated_sentence
 * @property string $searching_text
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class DictSentenceTranslation extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_sentence_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dict_language_id', 'dict_sentence_id', 'translated_sentence'], 'required'],
            [['dict_language_id', 'dict_sentence_id', 'data_status', 'create_user_id', 'update_user_id'], 'integer'],
            [['translated_sentence', 'searching_text'], 'string'],
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
            'dict_language_id' => 'Dict Language ID',
            'dict_sentence_id' => 'Dict Sentence ID',
            'translated_sentence' => 'Translated Sentence',
            'searching_text' => 'Searching Text',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
}
