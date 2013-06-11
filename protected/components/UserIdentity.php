<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	//private $_gid;
		
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{	
		$record = Users::model()->findByAttributes(array('username' => $this->username));
		if($record === null)
		    $this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($record->password !== sha1(md5($this->password)))
		    $this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
		    $this->_id = $record->id;
		    //$this->_gid = $record->group_id;
		    $this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	//public function getGid()
	//{
	//	return $this->_gid;
	//}

}