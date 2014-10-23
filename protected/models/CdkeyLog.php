<?php

/**
 * This is the model class for table "play_cdkey_log".
 *
 * The followings are the available columns in table 'play_cdkey_log':
 * @property string $id
 * @property string $platform
 * @property string $cdkey_type
 * @property string $cdkey
 * @property string $fans_name
 * @property integer $status
 * @property string $time
 * @property string $cdkey_id
 */
class CdkeyLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_cdkey_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('platform', 'length', 'max'=>16),
			array('cdkey_type, cdkey, fans_name, time', 'length', 'max'=>32),
			array('cdkey_id', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, platform, cdkey_type, cdkey, fans_name, status, time, cdkey_id', 'safe', 'on'=>'search'),
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
			'platform' => 'Platform',
			'cdkey_type' => 'Cdkey Type',
			'cdkey' => 'Cdkey',
			'fans_name' => 'Fans Name',
			'status' => 'Status',
			'time' => 'Time',
			'cdkey_id' => 'Cdkey',
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
		$criteria->compare('platform',$this->platform,true);
		$criteria->compare('cdkey_type',$this->cdkey_type,true);
		$criteria->compare('cdkey',$this->cdkey,true);
		$criteria->compare('fans_name',$this->fans_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('cdkey_id',$this->cdkey_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CdkeyLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
