<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $id
 * @property string $admin
 * @property string $name
 * @property string $password
 *
 * The followings are the available model relations:
 * @property Calendars[] $calendars
 * @property Forums[] $forums
 * @property Storages[] $storages
 * @property Users[] $users
 */
class Groups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin, name, password', 'required'),
			array('admin', 'length', 'max'=>255),
			array('name, password', 'length', 'max'=>100),
			array('name','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, admin, name, password', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'calendars' => array(self::HAS_MANY, 'Calendars', 'group_id'),
			'forums' => array(self::HAS_MANY, 'Forums', 'group_id'),
			'storages' => array(self::HAS_MANY, 'Storages', 'group_id'),
			'users' => array(self::HAS_MANY, 'Users', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'admin' => 'Admin',
			'name' => 'Nazwa',
			'password' => 'Password',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeValidate()
	{
		$this->admin = Users::model()->findByPk(Yii::app()->user->id)->username;
		$this->password = substr(strrev(str_replace('.', '', uniqid(time().md5(time()).sha1(time()), true))), 0, 10);
		return parent::beforeValidate();
	}
}