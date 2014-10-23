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

		//处理会员上传的图片
		$pic = $_FILES['w_pic'];
        if(!empty($pic['tmp_name'])){
            if(is_uploaded_file($pic['tmp_name'])){
                //把文件转存到你希望的目录
                $uploaded_file=$pic['tmp_name'];

                $user_path=$_SERVER['DOCUMENT_ROOT']."/uploads/member";

                //判断该用户是否已经有文件夹
                if(!file_exists($user_path)){

                    mkdir($user_path);
                }
				$file_true_name=$pic['name'];
                $b_pic_locaion="/".time().rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));
                $move_to_file=$user_path.$b_pic_locaion;
                if(!move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))){
                    echo "上传图片失败，请联系Simon";exit;
                }
            }
        }
		//生成缩略图
		$image   = $move_to_file;
		$im      = GetImageSize($image);
		switch($im[2]){
				case 1:
					$im=@ImageCreateFromGIF($image);
					break;
				case 2:
					$im=@ImageCreateFromJPEG($image);
					break;
				case 3:
					$im=@ImageCreateFromPNG($image);
					break;
		}
		$width = imagesx($im); 
		$height = imagesy($im);  
		$newwidth=200;
		$newheight=200;
		$newim = imagecreatetruecolor($newwidth, $newheight); 
		imageCopyreSampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
		
		$new_im_dir="uploads/member/small_".time().rand(1,1000).".jpg";

		ImageJpeg($newim,$new_im_dir,100);
		// Free up memory
		imagedestroy($newim);
		


		$id                      = $this->decrypt($this->token,$fans_id);
		$fansInfo				 = FansInfo::model()->findByPk($id);
		$fansInfo->fans_neck 	 = $fans_neck;
		$fansInfo->fans_sex 	 = $fans_sex;
		$fansInfo->fans_platform = $fans_platform;
		$fansInfo->fans_tag      = $fans_tag;
		$fansInfo->fans_desc     = $fans_desc;
		if(!empty($pic['tmp_name'])){
			//$fansInfo->fans_pic      = '/uploads/member'.$b_pic_locaion;
			$fansInfo->fans_pic      = '/'.$new_im_dir;
		}
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
          //  'BrowserControl',
        );
    }
}
