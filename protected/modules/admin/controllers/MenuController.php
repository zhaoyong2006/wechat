<?php
/**
* MenuController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-04-14 - created
* 
*/
class MenuController extends Controller{
	
	/**
	* index
	*/
	public function actionIndex(){
		$this->render("index");	
	}
	/**
	* 获取参数
	*/
	public function actionCreate_menu(){
		$appid = empty($_POST['appid'])?'':trim($_POST['appid']);
		$appsecret = empty($_POST['appsecret'])?'':trim($_POST['appsecret']);
		$access_json = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret);
		$access_arr = json_decode($access_json,true);
		$access_token = $access_arr['access_token'];
		//根据token修改自定义菜单
		$data = $this->wx_menu;
			
		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token);
 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 		$tmpInfo = curl_exec($ch);
		var_dump($tmpInfo);exit;
		$this->resText($tmpInfo);exit;
 		if (curl_errno($ch)) {
			$this->resText("自定义菜单失败");exit;
  			return curl_error($ch);
	 	}
 		curl_close($ch);
		$this->resText("自定义菜单成功");exit;
 		return $tmpInfo;
	}
}
