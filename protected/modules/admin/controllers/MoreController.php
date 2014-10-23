<?php
/**
* MoreController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-12 - created
* 
*/
class MoreController extends Controller{
	/**
	* 掌门帮展示
	*/	
	public function actionFriend($u,$cmd){
	//	echo "ok";exit;
		if(empty($u) || empty($cmd)){
			echo "params error";exit;
		}
		//将$u码解密
		$id = $this->decrypt($this->token,$u);
		//$userName = $this->decrypt('airmud',$u);	
		if(!is_numeric($id)){
			echo "error";exit;
		}
		//查询该用户信息
		//判断上一个还是下一个
		if($cmd == 'gotoPrevFriend'){
			$sql = "select * from play_fans_info where id < '".$id."' limit 0,1";
			$fansInfoModel = FansInfo::model();
            $fansInfo = $fansInfoModel->findBySql($sql);
            if(empty($fansInfo)){
				$sql = "select * from play_fans_info order by id DESC limit 0,1";
            	$fansInfo = $fansInfoModel->findBySql($sql);
			}
		}elseif($cmd == 'gotoNextFriend'){
			$sql = "select * from play_fans_info where id > '".$id."' limit 0,1";
            $fansInfoModel = FansInfo::model();
            $fansInfo = $fansInfoModel->findBySql($sql);
            if(empty($fansInfo)){
                $sql = "select * from play_fans_info order by id ASC limit 0,1";
                $fansInfo = $fansInfoModel->findBySql($sql);
            }
		}elseif($cmd == 'myself'){
			$sql = "select * from play_fans_info where id = '".$id."'";
        	$fansInfoModel = FansInfo::model();
        	$fansInfo = $fansInfoModel->findBySql($sql);
			//$this->renderPartial("friend",array('fansinfo'=>$fansInfo));
		}else{
			echo "params error";exit;
		}	
		$u = $this->encrypt($this->token,$fansInfo->attributes['id']);
		$this->renderPartial('friend',array(
									'fansinfo'=>$fansInfo,
									'u'       =>$u,));
	}
	/**
	* 信息
	*/
	public function actionCreate($u){
		//查询用户信息
		$fromUserName = $this->decrypt($this->token,$u);
		$fans_info = FansInfo::model()->findByPk($fromUserName);
		$sql = "select * from play_fans_info where fans_name = '".$fromUserName."'";
		$fans_info = FansInfo::model()->findBySql($sql);
		$this->renderPartial('create',array(
			'fans_info' => $fans_info,
		));
	}
	/**
	* 个人信息验证
	*/
	public function actionDoCreate(){
		$fans_id			  	 = trim(addslashes($_POST['fans_id']));
		$fans_neck 	 			 = trim(addslashes($_POST['fans_neck']));
		$fans_sex	 			 = trim(addslashes($_POST['fans_sex']));
		$fans_platform			 = trim(addslashes($_POST['fans_platform']));
		$fans_tag				 = trim(addslashes($_POST['fans_tag']));
		$fans_desc				 = trim(addslashes($_POST['fans_desc']));
		
		$id                      = $this->decrypt($this->token,$fans_id);
		$fansInfo				 = FansInfo::model()->findByPk($id);
		$fansInfo->fans_neck 	 = $fans_neck;
		$fansInfo->fans_sex 	 = $fans_sex;
		$fansInfo->fans_platform = $fans_platform;
		$fansInfo->fans_tag      = $fans_tag;
		$fansInfo->fans_desc     = $fans_desc;
		$fansInfo->update();
		//跳转到列表页
		
		$this->redirect(array('more/friend','cmd'=>'myself','u'=>$fans_id));
		echo "ok";exit;
	}
	/**
    * 浏览器控制filter
    */
    public function filters()
    {
        return array(
            'BrowserControl',
        );
    }
}
