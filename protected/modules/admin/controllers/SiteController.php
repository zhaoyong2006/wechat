<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//$memcache = new MemInfo();
		//$params = array(1=>'hanzi',2=>'18');
		$key = 'people';   
		$value = json_encode(array('name'=>'ball', 'age'=>'male'));   
		$expire = 10;   
		//Yii::app()->cache->set($key, $value);   
		var_dump(Yii::app()->cache->get($key));exit;   
		Yii::app()->cache->delete($key);
		exit;
		$params = "hello";
		//$res = $memcache->set('zhaoyong',$params,60);
		$value = Yii::app()->cache->get('zhaoyong');
		if($value !== false){
			echo $value;exit;
		}
		$res = Yii::app()->cache->set('zhaoyong',$params,60);
		if($res){
			//var_dump($memcache->get('zhaoyong'));
			var_dump(Yii::app()->cache->get('zhaoyong'));
		}else{  echo "no";}
		exit;
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->token."&openid=osoTojt9C2_9VGKG2Af9qs2e59HM&lang=zh_CN";
	//	$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=weilegexin&openid=osoTojt9C2_9VGKG2Af9qs2e59HM&lang=zh_CN";
	//	$fans_info = file_get_contents($url);
	//	var_dump($fans_info);exit;
		$this->render('index');
	}

	public function actionTest(){
	$memcache = new MemInfo();
            echo "11".$memcache->get('zhaoyong');
        exit;
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	/**
    * session控制filter
    */
    public function filters()
    {
        return array(
            'AccessControl',
        );
    }
}
