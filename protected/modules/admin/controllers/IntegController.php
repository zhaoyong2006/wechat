<?php
/**
* IntegController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-15 - created
* 
*/
class IntegController extends Controller{
	/**
	* 每日签到
	*/
	public function actionSign(){
		$start_date = empty($_POST['start_time'])?'':$_POST['start_time'];
		$end_date = empty($_POST['end_time'])?'':$_POST['end_time'];
		$fans_name = empty($_POST['fans_name'])?'':$_POST['fans_name'];
		$query = '';	
		if(!empty($start_date)){
			$start_time = strtotime($start_date);
			$query .= "and time > '".$start_time."'";
		}	
		if(!empty($end_date)){
			$end_time = strtotime($end_date)+3600*24;
			$query .= "and time < '".$end_time."'";
		}
		if(!empty($fans_name)){
			$query .= "and fans_name = '".$fans_name."'";
		}
		//获取用户积分
        $sql = "select * from play_sign_log where 1 ".$query." order by id DESC";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $log=$result->query();
		$this->render('sign',array(
                'log'=>$log,
                'pages'=>$pages,
				'start_date'=>$start_date,
				'end_date'=>$end_date,
				'fans_name'=>$fans_name,
        ));
        exit;	
	}
	
	/**
	* 礼包兑换记录
	*/
	public function actionCdkeyLog(){
        //获取用户积分
        $sql = "select * from play_cdkey_log order by id DESC";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $log=$result->query();
        $this->render('cdkey_log',array(
                'log'=>$log,
                'pages'=>$pages,
        ));
        exit;
	}
	/**
	* 礼包兑换
	*/
	public function actionConsume(){
		$this->render("consume");
	}
	/**
	* 礼包设置
	*/
	public function actionCdkey(){
		$cdkeyModel = Cdkey::model();
		$cdkey = $cdkeyModel->findAll();
		$this->render("cdkey",array(
			'cdkey' => $cdkey,
		));
	}
	/**
	* 添加礼包
	*/
	public function actionAddCdkey(){
		$this->render("addcdkey");
	}
	/**
	* 添加礼包操作
	*/
	public function actionDoAddCdkey(){
		$name        = trim(addslashes($_POST['name']));
		$cdkey_desc  = trim(addslashes($_POST['cdkey_desc']));
		$task_id     = trim(addslashes($_POST['task_id']));
		$cast_integ  = trim(addslashes($_POST['cast_integ']));
		$mark        = trim(addslashes($_POST['mark']));
		$status      = trim(addslashes($_POST['status']));		

		if(empty($name) || empty($task_id) || empty($mark)){
			$this->errorJump("参数不能为空");
		}
		$cdkey = new Cdkey();
		$cdkey->name 	   = $name;
		$cdkey->cdkey_desc = $cdkey_desc;
		$cdkey->task_id    = $task_id;
		$cdkey->cast_integ = $cast_integ;
		$cdkey->mark       = $mark;
		$cdkey->status     = $status;
		$cdkey->insert();
		$this->successJump('添加成功','integ/cdkey');
	}
	/**
	* 删除礼包
	*/
	public function actionDelCdkey($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}	
		$cdkey = new Cdkey();
		$cdkey->deleteByPk($id);
		$this->successJump("删除成功",'integ/cdkey');
	}
	/**
	* 修改礼包
	*/
	public function actionEditCdkey($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}
		$cdkeyModel = new Cdkey();
		$cdkey 		= $cdkeyModel->findByPK($id);
		$this->render("editcdkey",array(
			'cdkey'=>$cdkey,
		));		
	}
	/**
	* 修改礼包验证
	*/
	public function actionDoEditCdkey(){
		$id			 = trim(addslashes($_POST['id']));
		$name        = trim(addslashes($_POST['name']));
        $cdkey_desc  = trim(addslashes($_POST['cdkey_desc']));
        $task_id     = trim(addslashes($_POST['task_id']));
        $cast_integ  = trim(addslashes($_POST['cast_integ']));
        $mark        = trim(addslashes($_POST['mark']));
		$status      = trim(addslashes($_POST['status']));

        if(empty($id) || empty($name) || empty($task_id) || empty($mark)){
            $this->errorJump("参数不能为空");
        }
        $cdkey = Cdkey::model()->findByPk($id);
		$cdkey->name       = $name;
        $cdkey->cdkey_desc = $cdkey_desc;
        $cdkey->task_id    = $task_id;
        $cdkey->cast_integ = $cast_integ;
        $cdkey->mark       = $mark;
		$cdkey->status     = $status;
        $cdkey->update();
        $this->successJump('修改成功','integ/cdkey');	
	}
	/**
	* 导入观影券码
	*/
	public function actionLibaoAdd($id){
		$this->render("libaoAdd",array(
			'id' => $id,
		));
	}
	/**
	* 获取导入
	*/
	public function actionLibaoAddOk(){
		$libao_all = empty($_POST['libao'])?'':$_POST['libao'];
		$cdkey_id = empty($_POST['cdkey_id'])?'':$_POST['cdkey_id'];	
		$libao_arr = explode("\r\n",$libao_all);
		//将观影券插入数据库
		foreach($libao_arr as $k=>$v){
			$libaoModel = new Libao();
			$libaoModel->libao = $v;
			$libaoModel->cdkey_id = $cdkey_id;
			$libaoModel->status = '0';
			$res = $libaoModel->insert();
		}
		$this->successJump('添加成功！','integ/cdkey');
	
	}
	/**
	* 导入礼包列表
	*/
	public function actionLibaoList($id){
		//$libaoModel = Libao::model();
		//$libao_list = $libaoModel->findAll("cdkey_id=:cdkey_id",array(':cdkey_id'=>$id));
		$sql = "select * from play_libao where cdkey_id ='".$id."'";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts=$result->query();
		$this->render('libaoList',array(
			'libao' => $posts,
			'pages' => $pages,
		));	
	}
	/**
	* 大转盘	
	*/
	public function actionZhuanpan(){
		$sql = "select * from play_zhuanpan_log order by id DESC";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts=$result->query();
		$this->render('zhuanpan',array(
			'zhuanpan' => $posts,
			'pages' => $pages,
		));	
		
	}
	/**
	* 实物奖励列表
	*/
	public function actionShiwu(){
		$sql = "select * from play_zhuanpan_huojiang";
		$criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=20;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts=$result->query();
		$this->render('shiwu',array(
			'shiwu' => $posts,
			'pages' => $pages,
		));	
	}
	/**
	* 平台设置
	*/
	public function actionPlatform(){
		$platform = Platform::model();
		$platform_list = $platform->findAll();
		$this->render("platform",array(
			'platform'=>$platform_list,
		));
	}
	/**
	* 添加平台
	*/
	public function actionAddPlatform(){
		$this->render("addplatform");
	}
	/**
	* 添加平台验证
	*/
	public function actionDoAddPlatform(){
		$pkey    = trim(addslashes($_POST['pkey']));
		$pname 	 = trim(addslashes($_POST['pname']));
		$api_url = trim(addslashes($_POST['api_url']));
		$mark    = trim(addslashes($_POST['mark']));
		if(empty($pkey) || empty($pname) || empty($api_url) || empty($mark)){
			$this->errorJump("参数不能为空");
		}
		$platform = new Platform();
		$platform->pkey    = $pkey;
		$platform->pname   = $pname;
		$platform->api_url = $api_url;
		$platform->mark    = $mark;
		$platform->save();
		$this->successJump('添加成功！','integ/platform');
	}
	/**
	* 删除平台
	*/
	public function actionDelPlatform($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}
		$platformModel = new Platform();
		$platformModel->deleteByPk($id);
		$this->successJump("删除成功","integ/platform");
	}
	/**
	* 修改平台信息
	*/
	public function actionEditPlatform($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}	
		$platformModel = new Platform();
		$platform      = $platformModel->findByPk($id);
		$this->render("editplatform",array(
			'platform' => $platform,
		));
	}
	/**
	* 修改平台信息验证
	*/
	public function actionDoEditPlatform(){
		$id		 = trim(addslashes($_POST['id']));
		$pkey    = trim(addslashes($_POST['pkey']));
        $pname   = trim(addslashes($_POST['pname']));
        $api_url = trim(addslashes($_POST['api_url']));
        $mark    = trim(addslashes($_POST['mark']));
        if(empty($pkey) || empty($pname) || empty($api_url) || empty($mark)){
            $this->errorJump("参数不能为空");
        }
		$platformModel = Platform::model()->findByPk($id);
        $platformModel->id		= $id;
		$platformModel->pkey    = $pkey;
        $platformModel->pname   = $pname;
        $platformModel->api_url = $api_url;
        $platformModel->mark    = $mark;
        $platformModel->update();
        $this->successJump('修改成功！','integ/platform');	
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
