<?php
/**
* HomeController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-10 - created
* 
*/
class HomeController extends Controller{
	/**
	* 登陆
	*/
	public function actionIndex(){
		if($this->session['admin'] == 'playcrab'){
            $this->redirect(array('home/main'));
		}
		$this->renderPartial('login');
	}
	/**
	* 登录验证
	*/
	public function actionDoLogin(){
		$username = trim(addslashes($_POST['username']));
		$password = trim(addslashes($_POST['password']));
		$user = array(
			'simon'=>'zhaoyong',
		);

		if(@$user[$username] != $password){
			$this->errorJump('帐号或密码错误','home/index');
			exit;
		}
	$this->session['admin'] = $username;
	$this->redirect(array('home/main'));	
	}
	/**
	* 后台主页
	*/
	public function actionMain(){
		//获取用户总数
		$fansModel = Fans::model();
		$fansCount = $fansModel->count();
		//echo $fansCount;exit;
		/*$sql = "select count(distinct fans_name) as num from play_sign_log";
		$signModel = new SignLog();
		//$signModel = SignLog::model();
		$res = $signModel->findBySql($sql);
		//echo $res['num'];exit;
		echo "<pre>";
		print_r($res);
		echo "</pre>";exit;
		$huoren = $res['num'];
		echo $huoren;exit;
		*/$this->render('main',array('count'=>$fansCount));
	}
	/**
	* session控制filter
	*/
	public function filters()
    {
        return array(
            'AccessControl - index,doLogin',
        );
    }
	public function actionDoLogout(){
		$this->session->clear();	
		$this->session->destroy();

		$this->redirect(array('home/index'));
	}
}
