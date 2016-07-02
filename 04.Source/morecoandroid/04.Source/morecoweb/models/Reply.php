<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reply".
 *
 * @property integer $id
 * @property integer $ask_id
 * @property string $reply_content
 * @property integer $parent_reply_id
 * @property integer $reply_user_id
 * @property integer $vote
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Reply extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ask_id', 'reply_content', 'reply_user_id'], 'required'],
            [['ask_id', 'parent_reply_id', 'reply_user_id', 'vote', 'data_status', 'create_user_id', 'update_user_id'], 'integer'],
            [['reply_content'], 'string'],
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
            'ask_id' => 'Ask ID',
            'reply_content' => 'Reply Content',
            'parent_reply_id' => 'Parent Reply ID',
            'reply_user_id' => 'Reply User ID',
            'vote' => 'Vote',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
}
