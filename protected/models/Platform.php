<?php

/**
 * This is the model class for table "play_platform".
 *
 * The followings are the available columns in table 'play_platform':
 * @property string $id
 * @property string $pkey
 * @property string $pname
 * @property string $api_url
 * @property integer $mark
 */
class Platform extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'play_platform';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pkey, pname, api_url', 'required'),
			array('mark', 'numerical', 'integerOnly'=>true),
			array('pkey, pname', 'length', 'max'=>16),
			array('api_url', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pkey, pname, api_url, mark', 'safe', 'on'=>'search'),
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
			'pkey' => 'Pkey',
			'pname' => 'Pname',
			'api_url' => 'Api Url',
			'mark' => 'Mark',
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
		$criteria->compare('pkey',$this->pkey,true);
		$criteria->compare('pname',$this->pname,true);
		$criteria->compare('api_url',$this->api_url,true);
		$criteria->compare('mark',$this->mark);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Platform the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
