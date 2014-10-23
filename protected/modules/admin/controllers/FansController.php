<?php
/**
* FansController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-21 - created
* 
*/
//会员管理
class FansController extends Controller{
	public function actionIndex(){
		//$fansModel =Fans::model();
		$sql = "select * from play_fans order by id DESC";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts=$result->query();
        $this->render('index',array(
                'fans'=>$posts,
                'pages'=>$pages,
        ));
        exit;	
	}
	/**
	* 查看积分
	*/
	public function actionInteg($id){
		$sql = "select * from play_fans where id = '".$id."'";
		$fansModel = Fans::model();
		$res = $fansModel->findBySql($sql);
		$fans_integ = $res['integral'];
		//echo $fans_integ;
		$ret = array('s'=>'ok','name'=>$res['fans_name'],'integ'=>$fans_integ);
		die(json_encode($ret));
	}	
	/**
	* 积分更改操作
	*/
	public function actionUpdateInteg(){
		$fans_id = empty($_POST['fans_id'])?'':trim(addslashes($_POST['fans_id']));
		$integ   = empty($_POST['integ'])?'':trim(addslashes($_POST['integ']));
		if($fans_id == ''){
			$this->errorJump("post过来的数据为空，请联系管理员");
		}
		$fansModel = Fans::model()->findByPk($fans_id);
		$fansModel->integral = $integ;
		$res = $fansModel->update();
		if($res == 1){
			$this->successJump("积分变更成功！",'fans/index');
		}else{
			$this->errorJump("修改失败，请重试");
		}
	}
    public function actionGetmess(){
        $sql = 'select id as num from play_zhuanpan_log where jiangpin like "%公测礼包%"';
        $count = ZhuanpanLog::model()->count('jiangpin like :jiangpin',array(':jiangpin'=>'%观影券%'));
        echo "<pre>";
        print_r($count);
        echo "</pre>";exit;
    }
	/**
     *补cdkey
     */
    public function actionCdkey(){
        //查看未成功获得cdkey的玩家
        $sql ="select * from play_cdkey_log where cdkey='dasfasf(观影券)'";
        $fans = CdkeyLog::model()->findAllBySql($sql);

		$connection=Yii::app()->db; 
        $exec_res = array();
		foreach($fans as $v){
            $sql = "update play_fans set integral = integral + 11 where fans_name = '".$v->fans_name."'";
            $sql2 = "insert into play_cdkey_log(platform,cdkey_type,cdkey,fans_name,status,time,cdkey_id) value('common','buchang','已补偿11积分','".$v->fans_name."','1','".time()."','14')";
			$command = $connection->createCommand($sql);
			$res1 = $command->execute();
            $command2 = $connection->createCommand($sql2);
			$res2 = $command2->execute();
			if($res1 != 1 || $res2 != 1){
				//将执行结果存到数组中
				$exec_res[$v->fans_name] = array('jifen_res'=>$res1,'xiaoxi'=>$res2);
			}
		}
		echo "<pre>";
		print_r($exec_res);
		echo "</pre>ok";
        exit;
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
