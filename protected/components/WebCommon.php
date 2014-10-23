<?php
/**
* WebCommon.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-03-23 - created
* 
*/

class WebCommon{
	/**
	* 获取用户等级
	*/
	public function getGrade($integ){
		$vip = Yii::app()->params['vip'];	
		$grade = 0;	
		foreach($vip as $k=>$v){
			if($integ >= $v['integ']){
				$grade++;
			}
		}
		return $grade;
	}
}
