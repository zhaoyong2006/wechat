<?php
/**
* WxController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-10 - created
* 
*/
//entry controller
class WxController extends Controller{	
	// action entry
	public function actionEntry(){
		
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		//extract post data
		if(empty($postStr)){
			exit();	
		}
		$postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->fromUserName = $postObj->FromUserName;
        $this->toUserName   = $postObj->ToUserName;
		$msgType      = $postObj->MsgType;
		if($msgType == 'event'){
			$key = $postObj->EventKey;
            $filter = $this->guide[trim($key)]['filter']."filter";
			$res = $this->$filter();
			$this->resText($res);
			exit;
		}
        $keyword      = trim($postObj->Content);
		if($msgType == 'image'){
			//暂定设置头像
			$picUrl = $postObj->PicUrl;
			//$this->photofilter($fromUserName,$toUserName,$picUrl);
			$this->resText('欢迎关注本微信公众账号'.$picUrl);
            exit;	
		}
		if($msgType == 'location'){
			//暂定设置地理位置
		}
		if($msgType == 'voice'){
			//$recognition = $postObj->Recognition;
			//$this->resText('语音识别结果:'.$recognition);exit;
		}
		//$this->resText("lalal");exit;	
		if(array_key_exists($keyword,$this->guide)){
			$filter = $this->guide[$keyword]['filter']."filter";
			$res = $this->$filter();
			$this->resText($res);
			exit;
		}else{
			$this->resText('xxxxxxxxxxx');
            exit;
		}		
	}
	/**
	* 返回主菜单
	*/
	public function mainfilter(){
		//$memcache = new MemInfo();
		//$memcache->delete("lsq".$this->fromUserName);
		$this->resText($this->lang['welcome']);
    }
   /**
	* 删除cache中的数据
	*/
	public function flushcachefilter(){
		$memcache = new MemInfo();
        $memcache->flush();
        $this->resText("缓存清空完毕");exit;
	}
	/**
	* 请求最新活动
	*/
	public function raidersfilter(){
		//从数据库取出来存进数组
		$news = News::model();
		$sql = "select * from play_news where type='8' order by mark DESC,id DESC limit 0,5";
		$news_arr = $news->findAllBySql($sql);
		$this->resNews($news_arr);	
    }
    /**
     * 资讯
     */
    public function zixunfilter(){
        $news = News::model();
        $sql = "select * from play_news where type='1' order by mark DESC,id DESC limit 0,5";
        $news_arr = $news->findAllBySql($sql);
        $this->resNews($news_arr);
    }
	/**
	*/
	public function dzmfriendfilter(){
		$user_key 	   = $this->encrypt($this->token,$this->fromUserName); 
		$sql 	       = "select id from play_fans_info where fans_name = '".$this->fromUserName."'";
		$fansInfoModel = FansInfo::model(); 
		$fans = $fansInfoModel->findBySql($sql);
		$u  = $this->encrypt($this->token,$fans['id']);
		$timestamp = time(); 
		$str = "掌门帮是各位掌门展示自我的地方，我个性，我张杨!\n\n点击 <a href='http://".$this->domain."/index.php?r=more/create&u=".$user_key."'>设置我的名片</a>\n回复\"地址\"两个字开始设置我的地址\n\n点击<a href='http://".$this->domain."/index.php?r=more/friend&cmd=myself&u=".$u."&timestamp=".$timestamp."'>进入掌门帮</a>";	
		$this->resText($str);	
	}
	/**
	* 签到
	*/	
    public function qiandaofilter(){
        $this->checkFans();
        $content = array();
		$content['pic'] = "static/images/qiandao.jpg";
        $content['title'] = "每日签到";
        //$fans = $this->encrypt($this->token,$this->fromUserName);
        $fans = $this->fromUserName;
        $url = "http://".$this->domain."/index.php?r=user/sign&fans=".$fans;		
		$this->resNews($content,$url);exit;
    }
	/**
	* 获取用户积分
	*/
	public function getintegfilter(){
		$this->checkFans();	
		$sql ="select integral from play_fans where fans_name = '".$this->fromUserName."'";
		$fansModel = Fans::model();
		$res = $fansModel->findBySql($sql);
		$this->resText("总积分:".$res['integral']);exit;
	}
	/**
	* cdkey
	*/
	public function cdkeyfilter(){
        $this->checkFans();
        $content = array();
        $content['pic'] = "static/images/libao.jpg";
        $content['title'] = "积分兑换";
        //$fans = $this->encrypt($this->token,$this->fromUserName);
        $fans = $this->fromUserName;
        $url = "http://".$this->domain."/index.php?r=user/libao&fans=".$fans;
        $this->resNews($content,$url);exit;
	}
	/**
	* 检查用户
	*/
	public function checkFans(){
		$sql = "select * from play_fans where fans_name = '".$this->fromUserName."'";
        $fans = Fans::model()->findBySql($sql);
        if(empty($fans['fans_name'])){

            //加入到fans表
            $fans = new Fans();
            $fans->fans_name = $this->fromUserName;

			$fans->insert();
        }
	}
	/**
	* 自定义菜单
	*/
	public function createMenufilter(){
		//$data = $this->encrypt($this->token,$this->fromUserName); 
		//$this->resText("<a href='http://115.47.16.168/index.php?r=show/test&fans_name=".urlencode($data)."'>1111</a>");exit;
		$data = $this->wx_menu;exit;
		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=f6faiD7PtwGUrYAyv8cAee-XuhRISwrPZOi2UHFxb9_psf2Czd_picLgRSdsV_por71aaV2KaU6e10Xz96HyIknuHIE8bmN4CvOIRedelt0RSP0bQBVeh0QOR6nJKmpuYsT8K6-RMizhkptb1Ihtyg");
 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 		$tmpInfo = curl_exec($ch);
		$this->resText($tmpInfo);exit;
 		if (curl_errno($ch)) {
			$this->resText("自定义菜单失败");exit;
  			return curl_error($ch);
	 	}
 		curl_close($ch);
		$this->resText("自定义菜单成功");exit;
 		return $tmpInfo;
	}
	/**
	* 删除自定义菜单
	*/
	public function delMenufilter(){
		$ch = curl_init("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->token) ;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
		$output = curl_exec($ch) ;
		$this->resTest($output);
	}
}
