<?php

/**
 * This is the model class for table "play_cdkey".
 *
 * The followings are the available columns in table 'play_cdkey':
 * @property string $id
 * @property string $name
 * @property string $cdkey_desc
 * @property string $task_id
 * @property integer $cast_integ
 * @property integer $mark
 * @property integer $status
 */
class Cdkey extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_cdkey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('cast_integ, mark, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('cdkey_desc', 'length', 'max'=>128),
			array('task_id', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, cdkey_desc, task_id, cast_integ, mark, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'cdkey_desc' => 'Cdkey Desc',
			'task_id' => 'Task',
			'cast_integ' => 'Cast Integ',
			'mark' => 'Mark',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cdkey_desc',$this->cdkey_desc,true);
		$criteria->compare('task_id',$this->task_id,true);
		$criteria->compare('cast_integ',$this->cast_integ);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cdkey the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
