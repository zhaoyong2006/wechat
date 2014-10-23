<?php

/**
 * This is the model class for table "play_zhuanpan_huojiang".
 *
 * The followings are the available columns in table 'play_zhuanpan_huojiang':
 * @property string $id
 * @property integer $log_id
 * @property string $fans_name
 * @property string $consignee
 * @property string $address
 * @property string $phone
 * @property string $time
 * @property integer $status
 * @property string $extra
 */
class ZhuanpanHuojiang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_zhuanpan_huojiang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('log_id, fans_name, time', 'required'),
			array('log_id, status', 'numerical', 'integerOnly'=>true),
			array('fans_name, consignee, extra', 'length', 'max'=>32),
			array('address', 'length', 'max'=>256),
			array('phone, time', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, log_id, fans_name, consignee, address, phone, time, status, extra', 'safe', 'on'=>'search'),
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
			'log_id' => 'Log',
			'fans_name' => 'Fans Name',
			'consignee' => 'Consignee',
			'address' => 'Address',
			'phone' => 'Phone',
			'time' => 'Time',
			'status' => 'Status',
			'extra' => 'Extra',
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
		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('fans_name',$this->fans_name,true);
		$criteria->compare('consignee',$this->consignee,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('extra',$this->extra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ZhuanpanHuojiang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
