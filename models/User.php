<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->where(['=', 'token', $token])->andWhere(['>', 'token_expire', time()])->one();
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($user_name)
    {
        return static::findOne([
            'user_name'=>$user_name
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateToken()
    {
        $this->token = \Yii::$app->security->generateRandomString();
        $this->token_expire = strtotime('+1 days');
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuth()
    {
        $this->authKey = \Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return '75yhr7drme';
        //return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return '75yhr7drme' === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
        //return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
