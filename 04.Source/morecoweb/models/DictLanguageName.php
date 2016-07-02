<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dict_language_name".
 *
 * @property integer $id
 * @property integer $dict_language_id
 * @property integer $in_language_id
 * @property string $name
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class DictLanguageName extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_language_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dict_language_id', 'in_language_id', 'name'], 'required'],
            [['dict_language_id', 'in_language_id', 'data_status', 'create_user_id', 'update_user_id'], 'integer'],
            [['name'], 'string'],
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
            'in_language_id' => 'In Language ID',
            'name' => 'Name',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
}
