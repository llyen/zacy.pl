<?php

/**
 * This is the model class for table "threads".
 *
 * The followings are the available columns in table 'threads':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $owner_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Posts[] $posts
 * @property Forums $forum
 * @property Users $owner
 */
class Threads extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Threads the static model class
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
		return 'threads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('forum_id, owner_id, name', 'required'),
			array('forum_id, owner_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, forum_id, owner_id, name', 'safe', 'on'=>'search'),
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
			'posts' => array(self::HAS_MANY, 'Posts', 'thread_id'),
			'forum' => array(self::BELONGS_TO, 'Forums', 'forum_id'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'forum_id' => 'Forum',
			'owner_id' => 'Owner',
			'name' => 'Name',
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
		$criteria->compare('forum_id',$this->forum_id);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}