<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_user".
 *
 * @property integer $id
 * @property string $account
 * @property string $password
 * @property integer $email
 * @property integer $role
 * @property integer $data_status
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class AppUser extends BaseBatsgModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account'], 'required'],
            [['account', 'password'], 'string'],
            [['email', 'role', 'data_status', 'create_user_id', 'update_user_id'], 'integer'],
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
            'account' => 'Account',
            'password' => 'Password',
            'email' => 'Email',
            'role' => 'Role',
            'data_status' => 'Data Status',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User ID',
            'update_time' => 'Update Time',
            'update_user_id' => 'Update User ID',
        ];
    }
}
