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
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
	public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }	
	/**
	* index
	*/
	public function actionIndex(){
		//$url = "http://115.47.16.168:82/foreach.php";
		//$params = array("id"=>12);
		//$curl = new Curl();
		//$res = $curl->get($url,$params);
		//echo $res;exit;
		//获取appid 和appsecret	
		$settingModel = new Setting();
		$keySetting = $settingModel->findAll('name=:appId or name=:appSecret',array(':appId'=>'appId',':appSecret'=>'appSecret'));
	//	$params = array(
	//			'appId'=>$keySetting[0]->value,
	//			'appSecret'=>$keySetting[1]->value,	
	//			);
		//$this->render("index",$params);exit;
		if(empty($keySetting[0]->value) || empty($keySetting[1]->value)){
			//echo "请设置appId和appSecret";exit;
			$this->render("index");exit;
		}
		//去除自定义菜菜单设
		$res = $settingModel->find('name=:wx_menu',array(':wx_menu'=>'wx_menu'));
		$params = array();
		if(!empty($res->value)){
			$params['wx_menu'] = json_decode($res->value,true);
		}else{
			$params['wx_menu'] = array();
		}
		//echo "<pre>";
		//print_r($res->name.":".$res->value);exit;
		$this->render("menu",$params);	
	}
	public function actionAjax_save_key(){
        $appid = empty($_POST['appid'])?'':trim($_POST['appid']);
		$appsecret = empty($_POST['appsecret'])?'':trim($_POST['appsecret']);
		if(empty($appid) || empty($appsecret)){
			$respose = array('s'=>1001,'msg'=>"参数不全");
			die(json_encode($respose));
		}
		$setting = new Setting();
		$setting->updateAll(array('value'=>$appid),"name=:appid",array(":appid"=>'appId'));
		$setting->updateAll(array('value'=>$appsecret),"name=:appsecret",array(":appsecret"=>'appSecret'));

		$respose = array('s'=>0,'msg'=>"保存成功");
		die(json_encode($respose));
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
