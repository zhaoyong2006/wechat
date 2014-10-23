<?php

/**
 * This is the model class for table "play_zhuanpan_log".
 *
 * The followings are the available columns in table 'play_zhuanpan_log':
 * @property string $id
 * @property string $fans_name
 * @property string $jiangpin
 * @property integer $jiangpin_type
 * @property string $cast_integ
 * @property string $time
 */
class ZhuanpanLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_zhuanpan_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fans_name, jiangpin, jiangpin_type, time', 'required'),
			array('jiangpin_type', 'numerical', 'integerOnly'=>true),
			array('fans_name', 'length', 'max'=>32),
			array('jiangpin', 'length', 'max'=>64),
			array('cast_integ', 'length', 'max'=>8),
			array('time', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fans_name, jiangpin, jiangpin_type, cast_integ, time', 'safe', 'on'=>'search'),
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
			'jiangpin' => 'Jiangpin',
			'jiangpin_type' => 'Jiangpin Type',
			'cast_integ' => 'Cast Integ',
			'time' => 'Time',
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
		$criteria->compare('jiangpin',$this->jiangpin,true);
		$criteria->compare('jiangpin_type',$this->jiangpin_type);
		$criteria->compare('cast_integ',$this->cast_integ,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ZhuanpanLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
