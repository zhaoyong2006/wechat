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
		Yii::app()->user->returnUrl = "/admin/home/main";
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->user->returnUrl);
			//$this->redirect(array('home/main'));
		}
		$this->renderPartial('login');
	}
	/**
	* 登录验证
	*/
	public function actionDoLogin(){
		$username = trim(addslashes($_POST['username']));
		$password = trim(addslashes($_POST['password']));

		$identity = new UserIdentity($username,$password);
		if($identity->authenticate())
				Yii::app()->user->login($identity);
		else
				echo $identity->errorMessage;

		$this->redirect(Yii::app()->user->returnUrl);
		//$this->redirect(array('home/main'));

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
            'accessControl - index,doLogin',
        );
    }
	public function actionDoLogout(){
		Yii::app()->user->logout();
		
		$this->redirect(array('home/index'));
		
	}
}
