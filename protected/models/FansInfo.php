<?php

/**
 * This is the model class for table "play_fans_info".
 *
 * The followings are the available columns in table 'play_fans_info':
 * @property string $id
 * @property string $fans_name
 * @property string $fans_neck
 * @property integer $fans_sex
 * @property string $fans_pic
 * @property string $fans_locax
 * @property string $fans_locay
 * @property string $fans_platform
 * @property string $fans_tag
 * @property string $fans_desc
 * @property string $time
 * @property integer $status
 */
class FansInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_fans_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fans_name', 'required'),
			array('fans_sex, status', 'numerical', 'integerOnly'=>true),
			array('fans_name, fans_neck, fans_locax, fans_locay, fans_platform, time', 'length', 'max'=>32),
			array('fans_pic', 'length', 'max'=>64),
			array('fans_tag, fans_desc', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fans_name, fans_neck, fans_sex, fans_pic, fans_locax, fans_locay, fans_platform, fans_tag, fans_desc, time, status', 'safe', 'on'=>'search'),
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
			'fans_name' => 'Fans Name',
			'fans_neck' => 'Fans Neck',
			'fans_sex' => 'Fans Sex',
			'fans_pic' => 'Fans Pic',
			'fans_locax' => 'Fans Locax',
			'fans_locay' => 'Fans Locay',
			'fans_platform' => 'Fans Platform',
			'fans_tag' => 'Fans Tag',
			'fans_desc' => 'Fans Desc',
			'time' => 'Time',
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
		$criteria->compare('fans_name',$this->fans_name,true);
		$criteria->compare('fans_neck',$this->fans_neck,true);
		$criteria->compare('fans_sex',$this->fans_sex);
		$criteria->compare('fans_pic',$this->fans_pic,true);
		$criteria->compare('fans_locax',$this->fans_locax,true);
		$criteria->compare('fans_locay',$this->fans_locay,true);
		$criteria->compare('fans_platform',$this->fans_platform,true);
		$criteria->compare('fans_tag',$this->fans_tag,true);
		$criteria->compare('fans_desc',$this->fans_desc,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FansInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
