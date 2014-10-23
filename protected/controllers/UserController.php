<?php
/**
* UserController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-02-18 - created
* 
*/
class UserController extends Controller{
	/**
	* 签到
	*/
	public function actionSign(){
		//获取最后一次签到时间
		//$fans = empty($_GET['fans'])?'':trim(addslashes($_GET['fans']));	
        $fans = empty($_GET['fans'])?'':$_GET['fans'];
        if(empty($fans)){
			echo "<h1>ERROR</h1>";exit;
		}
        //获取最新活动
		$newsModel = News::model();
		$huodong = $newsModel->findAll("type=:type limit 0,3",array(':type'=>1));
		$this->renderPartial("sign",array(
				'fans'=>$fans,
				'news'=>$huodong,
			));
			
	}
	/**
	* 签到响应
	*/
	public function actionSignok(){
		
		//$fans = empty($_GET['fans'])?'':trim(addslashes($_GET['fans']));
        $fans = empty($_GET['fans'])?'':$_GET['fans'];
//        $fans_name = $this->decrypt($this->token,$fans);
        $fans_name = $fans;
        //    echo $fans."<br/>".$fans_name;exit;
        if(empty($fans_name)){
			echo "<h1>ERROR</h1>";exit;
		}
        //判断今天是否已经签到
		$FansModel = Fans::model();
        $sql = "select * from play_fans where fans_name = '".$fans_name."'";
        $fans_info = $FansModel->findBySql($sql);
        //获取玩家等级
		$grade = WebCommon::getGrade($fans_info['integral']);		    
		$last_date=date("Y-m-d",$fans_info['integ_time']);
        //最后登录的日期时间戳
        $last_time=strtotime($last_date);

        $now_date=date("Y-m-d",time());
        //现在日期的时间戳
        $now_time=strtotime($now_date);
        if($last_time>=$now_time){
        	//今日已签到
			$this->renderPartial("signok",array(
				'mess'=>"抱歉，主公，您今天已经签过到了~",
				'integ'=>$fans_info['integral'],
                'grade'=>$grade,
                'fans' =>$fans,    
			));exit;
		}
        $integ = 10;
        $time = time();

        $fansModel = $FansModel->findByPk($fans_info['id']);
        $fansModel->integral = $fans_info['integral']+$integ;
        $fansModel->integ_time = $time;

        //把签到记录写入到play_sign_log表中
        $signLog = new SignLog();
        $signLog->fans_name = $fans_name;
        $signLog->integral = $integ;
        $signLog->time = $time;

		//使用事务
        $transaction = Yii::app()->db->beginTransaction();
        try{
            $fansModel->update();
            $signLog->insert();
            $transaction->commit();
        }catch(Exception $e){
            $transaction->rollback();
        }	
		//签到成功
		$this->renderPartial("signok",array(
			'mess'=>"签到成功，获得".($integ)."积分~",
			'integ'=>($fans_info['integral']+$integ),
			'fans_name'=>$fans_name,
			'grade'=>$grade, 
            'fans' =>$fans,    
		));
		exit;
	}
	/**
	*	about integ more
	*/
	public function actionMore(){
		$this->renderPartial("more",array(
			'vip' => Yii::app()->params['vip'],
		));
	}

	/**
	* cdkey
	*/
	public function actionCdkey(){
		$fans_name = empty($_GET['fans_name'])?'':trim(addslashes($_GET['fans_name']));
        if(empty($fans_name)){
            echo "<h1>ERROR</h1>";exit;
        }
		$this->renderPartial("cdkey",array(
			'fans_name' => $fans_name,
		));
	}
	
	/**
	* libao
	*/
	public function actionLibao(){
		$fans = empty($_GET['fans'])?'':trim(addslashes($_GET['fans']));
        if(empty($fans)){                                  
            echo "<h1>ERROR</h1>";exit;                         
        }
		//查询所有礼包
		$cdkeyModel = Cdkey::model();
		$cdkey      = $cdkeyModel->findAll(array('order'=>'mark','condition'=>'status=:status','params'=>array(':status'=>0)));
		$this->renderPartial("libao",array(
			'cdkey'     => $cdkey,
			'fans' => $fans,
		));
	}

	/**
	* libao ok
	*/
	public function actionLibao_re($id){
		$fans = empty($_GET['fans'])?'':trim(addslashes($_GET['fans']));
        if(empty($fans)){                                  
            echo "<h1>ERROR</h1>";exit;                         
        }
        $fans_name = $fans;
        //$fans_name = $this->decrypt($this->token,$fans);
		//查询该礼包信息
		$cdkey = Cdkey::model()->findByPk($id);
		if(empty($cdkey) || $cdkey['status'] != 0){
			echo "<h1>ERROR</h1>";exit;
		}
		//查询改用户信息
		$user_info = Fans::model()->find("fans_name=:fans_name",array(':fans_name'=>$fans_name));
		if(count($user_info) == 0){
			echo "<h1>ERROR</h1>";exit;
        }
        //获取用户兑换记录
        $cdkeyLogModel = CdkeyLog::model();
        $cdkey_log = $cdkeyLogModel->findAll("fans_name=:fans_name",array(':fans_name'=>$fans_name));
        if($cdkey->cast_integ > $user_info->integral){
			//积分不足
            $this->renderPartial('cdkey',array(
                    's'   => 'no',
                    'msg' => '对不起，您的积分不足',
                    'integral' => $user_info->integral,
                    'cdkey_log'=>$cdkey_log,
                    'fans' => $fans,
                ));exit;
		}
		//在账户中除去积分
	
		//检查用户是否已经获取过该礼包
        $sql = "select count(*) from play_cdkey_log where fans_name = '".$fans_name."' and cdkey_id='".$id."'";
        $count = $cdkeyLogModel->countBySql($sql);
        if($count > 0){
            $this->renderPartial('cdkey',array(
                    's'   => 'no',
                    'msg' => '<b>您已经兑换过该礼包了，无法重复兑换</b>',
                    'integral' => $user_info->integral,
                    'cdkey_log'=>$cdkey_log,
                    'fans' => $fans,
                ));exit;
        }
   		//判断是否为观影券
		if($cdkey['mark'] == '10'){
			//从数据库中获取一枚观影券
			$libaoModel = new Libao();
			$libao  = $libaoModel->find("cdkey_id=:cdkey_id and status = '0'",array(':cdkey_id'=>$cdkey['id']));
			if(empty($libao)){
				$this->renderPartial('cdkey',array(
                	's'   => 'no',
                	'msg' => '<b>对不起，该礼包已经被抢光了</b>',
                	'integral' => $user_info->integral,
                	'cdkey_log'=>$cdkey_log,
                	'fans' => $fans,
            	));exit;
			}
			//将改礼包状态设为1
			$libao_update = $libaoModel->findByPk($libao->id);
			$libao_update->status = '1';
			$libao_update->save();				
			$cdkey_val = $libao->libao."";
		}else{ 
		//get cdkey by api
		$cdkey_val = $this->getCdkey($cdkey['task_id']);
		if($cdkey_val == '49'){
            
            $this->renderPartial('cdkey',array(
                's'   => 'no',
                'msg' => '<b>该礼包已过期</b>',
                'integral' => $user_info->integral,
                'cdkey_log'=>$cdkey_log,
                'fans' => $fans,
            ));exit;
		}elseif($cdkey_val == '5'){
            $this->renderPartial('cdkey',array(
                's'   => 'no',
                'msg' => '<b>出错了，请尝试兑换其他礼包</b>',
                'integral' => $user_info->integral,
                'cdkey_log'=>$cdkey_log,
                'fans' => $fans,
            ));exit;
		}elseif($cdkey_val == '13'){
            
            $this->renderPartial('cdkey',array(
                's'   => 'no',
                'msg' => '<b>对不起，该礼包已经被抢光了</b>',
                'integral' => $user_info->integral,
                'cdkey_log'=>$cdkey_log,
                'fans' => $fans,
            ));exit;
		}
		}
        $fansModel = new Fans();        
		//扣除积分
		$new_integ = $user_info->integral - $cdkey['cast_integ'];
        $fansModel->updateAll(array('integral'=>$new_integ),'fans_name=:fans_name',array(':fans_name'=>$fans_name));	

		//将兑换数据存入表中
		$cdkeylogModel = new CdkeyLog();
		$cdkeylogModel->platform   = 'common';
		$cdkeylogModel->cdkey_type = $cdkey['name'];
		$cdkeylogModel->cdkey      = $cdkey_val;
		$cdkeylogModel->fans_name  = $fans_name;
		$cdkeylogModel->status     = '1';
		$cdkeylogModel->time       = time();
		$cdkeylogModel->cdkey_id   = $cdkey['id'];
		$cdkeylogModel->insert();	
             
        $this->renderPartial('cdkey',array(
                's'   => 'yes',
                'msg' => $cdkey_val,
                'integral' => $user_info->integral,
                'cdkey_log'=>$cdkey_log,
                'fans' => $fans,
        ));exit;
        /*echo "您的cdkey为:".$cdkey_val."剩余积分:".$new_integ;exit;
        
        echo "<pre>";
		print_r($cdkey);
		echo "</pre>";
		echo "<pre>";
		print_r($user_info);
		echo "</pre>";exit;*/
		//查询用户积分信息
		
    }
	/**
	* 大转盘
	*/
	public function actionZhuanpan($fans_name){
		if(empty($fans_name)){
			echo "<h1>ERROR</h1>";exit;
		}
		//获取获奖记录	
		$jilu = ZhuanpanLog::model()->findAll("fans_name=:fans_name and jiangpin_type<>'0' order by id DESC",array(':fans_name'=>$fans_name));
		$this->renderPartial("zhuanpan",array(
			'jilu' => $jilu,
			'fans_name' => $fans_name,
		));	
	}
	/**
	* ajax大转盘
	*/
	public function actionAjaxzhuanpan(){
        
		//$respose['s'] = 'ok';
		//$respose['data'] = array('id'=>'activityend');
		//die(json_encode($respose));
        $fans_name = empty($_POST['fans_name'])?'':trim($_POST['fans_name']);
		$this->checkUser($fans_name);
		//查询是否为第一次转
		//$log_count = ZhuanpanLog::model()->count("fans_name=:fans_name",array(':fans_name'=>$fans_name));
		$insert = array();	
		//if($log_count > 0){
			//扣积分
			$fans_info = Fans::model()->find("fans_name=:fans_name",array(':fans_name'=>$fans_name));
			if($fans_info['integral'] < 30){
				//积分不足
				$respose['s'] = 'ok';
				$respose['data'] = array('id'=>'nointeg');
				die(json_encode($respose));
			}	
        	$fansModel = new Fans();        
			//扣除积分
			$new_integ = $fans_info['integral'] - 30;
        	$fansModel->updateAll(array('integral'=>$new_integ),'fans_name=:fans_name',array(':fans_name'=>$fans_name));	
			$insert['integ'] = '30';
		//}else{
		//	$insert['integ'] = '0';
		//}	
			$jiangpin = $this->getjiangpin();
			//礼包task_id列表
			$task_id = array();
			//$task_id['yinbi'] = '537585cb06703f1231000000';
			$task_id['yinbi'] = '5379cba106703fb330000001';
			//$task_id['baozi'] = '5375b87d06703f3f30000000'; //
			$task_id['baozi'] = '5379cb0d06703fa230000002'; //
			//$task_id['jitui'] = '5375854806703fb030000000'; //
			$task_id['jitui'] = '5379ca0806703f7b30000003'; //
			//$task_id['zhuanpan'] = '5375871306703fe930000000'; //
			$task_id['zhuanpan'] = '5379c61206703f3430000000'; //
			$task_id['chaozhi'] = ''; //超值礼包

			$respose['s'] = 'ok';
			if($jiangpin == 'huoji'){	
				//相框
				$zhuanpanLog = new ZhuanpanLog();
				$XKcount = $zhuanpanLog->count("jiangpin=:jiangpin",array(':jiangpin'=>'限量打火机'));
				if($XKcount >= 10){
					$respose['data']=array(
						'id' => 1,
					);
					$insert['jiang'] = "未获奖";
					$insert['type'] = 4;	
				}else{
					$respose['data'] = array(
						'id' => 2,
					);
					$insert['jiang'] = "限量打火机";
					$insert['type'] = 2;
				}

			}elseif($jiangpin == 'yinbi'){
				//银币礼包
				$cdkey_val = $this->getCdkey($task_id['yinbi']);
				if(strlen($cdkey_val) < 8){
					//礼包没有了
					$respose['data']=array(
						'id' => 1,
					);
					$insert['jiang'] = "未获奖";
					$insert['type'] = 4;	
				}else{
                	$respose['data']=array(
                    	'id' => 3, 
                    	'cdkey' => $cdkey_val,
                	); 
                	$insert['jiang'] = "银币礼包".$cdkey_val;
                	$insert['type'] = 3;	
				}
			}elseif($jiangpin == 'baozi'){
				//包子礼包
				$cdkey_val = $this->getCdkey($task_id['baozi']);
				if(strlen($cdkey_val) < 8){
					//礼包没有了
					$respose['data']=array(
						'id' => 1,
					);
					$insert['jiang'] = "未获奖";
					$insert['type'] = 4;	
				}else{
                	$respose['data']=array(
                    	'id' => 4, 
                    	'cdkey' => $cdkey_val,
                	); 
                	$insert['jiang'] = "包子礼包".$cdkey_val;
                	$insert['type'] = 3;	
				}
			}elseif($jiangpin == 'jitui'){
				//鸡腿礼包
				$cdkey_val = $this->getCdkey($task_id['jitui']);
				if(strlen($cdkey_val) < 8){
					//礼包没有了
					$respose['data']=array(
						'id' => 1,
					);
					$insert['jiang'] = "未获奖";
					$insert['type'] = 4;	
				}else{
                	$respose['data']=array(
                    	'id' => 5, 
                    	'cdkey' => $cdkey_val,
                	); 
                	$insert['jiang'] = "鸡腿礼包".$cdkey_val;
                	$insert['type'] = 3;	
				}
			}elseif($jiangpin == 'zhuanpan'){
				//转盘礼包
				$cdkey_val = $this->getCdkey($task_id['zhuanpan']);
				if(strlen($cdkey_val) < 8){
					//礼包没有了
					$respose['data']=array(
						'id' => 1,
					);
					$insert['jiang'] = "未获奖";
					$insert['type'] = 4;	
				}else{
                	$respose['data']=array(
                    	'id' => 6, 
                    	'cdkey' => $cdkey_val,
                	); 
                	$insert['jiang'] = "转盘大礼包".$cdkey_val;
                	$insert['type'] = 3;	
				}

			}else{	
				$respose['data']=array(
					'id' => 1,
				);
				$insert['jiang'] = "未获奖";
				$insert['type'] = 4;
			}
			//将数据存入log
			$zhuanpanLog = new ZhuanpanLog();
			$zhuanpanLog->fans_name = $fans_name;
			$zhuanpanLog->jiangpin = $insert['jiang'];
			$zhuanpanLog->jiangpin_type = $insert['type'];
			$zhuanpanLog->cast_integ = $insert['integ'];
			$zhuanpanLog->time = time();
			$zhuanpanLog->save(); 
			die(json_encode($respose));
			
	}
	public function getjiangpin(){
		$num = rand(1,10000);
        if($num < '4001'){
			//银币礼包
			return 'yinbi';
		}elseif($num > 4000 && $num < 7001){
			//肉包子
			return 'baozi';
		}elseif($num > 7000 && $num < 9001){
			//肥鸡腿
			return 'jitui';
		}elseif($num > 9000 && $num < 9501){
			//转盘大礼包
			return 'zhuanpan';
		}elseif($num >9500 && $num < 9518){
			//打火机
			return 'huoji';
		}else{
			return 'mei';
		}
	}
	/**
	* 获取实物奖励
	*/
	public function actionGetshiwu(){
		//查询log中有实物奖励，但没进入数据库具体时间的
		//查询log中实物数量
		$fans_name = empty($_POST['fans_name'])?'':$_POST['fans_name'];
		$consignee = empty($_POST['consignee'])?'':$_POST['consignee'];
		$address = empty($_POST['address'])?'':$_POST['address'];	
		$phone = empty($_POST['phone'])?'':$_POST['phone'];

		$log_count = ZhuanpanLog::model()->count("fans_name=:fans_name and jiangpin_type='2'",array(':fans_name'=>$fans_name));
		$shiwu_count = ZhuanpanHuojiang::model()->count("fans_name=:fans_name",array(":fans_name"=>$fans_name));
		if($log_count <= $shiwu_count){
			echo "<h1>ERROR</h1>";exit;
		}			
		//获取最新的一次logid
		$log = ZhuanpanLog::model()->find("fans_name=:fans_name and jiangpin_type='2' order by id DESC",array(":fans_name"=>$fans_name));
		//将数据存入数据库
		$zhuanpan = new ZhuanpanHuojiang();
		$zhuanpan->log_id = $log->id;
		$zhuanpan->fans_name = $fans_name;
		$zhuanpan->consignee = $consignee;
		$zhuanpan->address   = $address;
		$zhuanpan->phone     = $phone;
		$zhuanpan->time      = time();
		$zhuanpan->status    = '0';
		$zhuanpan->insert();
		echo "ok";
		$this->redirect(array('user/zhuanpan','fans_name'=>$fans_name)); 	
	}
    /**
     * 检查用户是否存在
     */
    public function checkUser($fans_name){
        $user_info = Fans::model()->find("fans_name=:fans_name",array(':fans_name'=>$fans_name)); 
        if(empty($user_info)){
            echo "<h2>ERROR</h2>";exit;
        }
        return true;
    }
	/**
    * 浏览器控制
    */
    public function filters(){
        return array(
        //    'BrowserControl',
        );
    }
}
