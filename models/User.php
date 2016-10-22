<?php

namespace app\models;

use Yii;
//use yii\base\NotSupportedException;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord  implements IdentityInterface
{
    /*public $id;
    public $username;
    public $password_hash;
    public $auth_key;
    public $access_token;*/

   /* private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password_hash' => 'admin',
            'auth_key' => 'test100key',
            'access_token' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password_hash' => 'demo',
            'auth_key' => 'test101key',
            'access_token' => '101-token',
        ],
    ];*/

	public static function tableName(){
		return 'user';
	}

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
	    return static::findOne(['id'=>$id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['access_token'] === $token) {
                return new static($user);
            }
        }

        return null;*/
        return static::findOne(['access_token'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;*/
        return static::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /*public function getUsername(){
    	return $this->username;
    }

    public function getPasswordHash(){
    	return $this->password_hash;
    }*/
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password_hash === $password_hash;
	    return Yii::$app->security->validatePassword($password, $this->password_hash);
	    // password_verify($password, $this->password_hash);
    }

	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}


	public function generateAuthKey(){
    	$this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert){
    	if(parent::beforeSave($insert)){
    		if($this->isNewRecord){
    			$this->auth_key = $this->generateAuthKey();
		    }
		    return true;
	    }
	    return false;
    }
}
