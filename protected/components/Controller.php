<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/play';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	public $guide = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	protected $fromUserName = '';
	
	protected $toUserName = '';

	protected $session;

	protected $token;

	protected $domain;	

	protected $cdn;
	
	protected $lang;

	protected $wx_menu;	
	//response type
	protected $resModel;

	private $api_url = "";
	//初始化
	public function init(){
		$this->token    = Yii::app()->params['token'];
		$this->resModel = Yii::app()->params['resModel'];
		$this->menu     = Yii::app()->params['menu'];
		$this->guide    = Yii::app()->params['guide'];
		$this->session  = Yii::app()->session;
		$this->domain   = Yii::app()->params['domain'];
		$this->cdn      = Yii::app()->params['cdn'];
		//加载语言
		$this->lang     = Yii::app()->params['lang'];
		//自定义菜单
		$this->wx_menu  = Yii::app()->params['wx_menu'];
	}
	/**
	* get cdkey from api
	*/
	protected function getCdkey($task_id){
	  	$durl = $this->api_url.$task_id;
			$i = 0;
        $r = '';
        $user = "playcrab";
        $pass = "airmud";
        while($r == ''){
            if($i == 4){
                sleep(2);
            }
            if($i == 8){
                echo "error";exit;
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $durl);
            // 设置header
            curl_setopt($curl, CURLOPT_HEADER, 0);
 
            // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, "{$user}:{$pass}");
            $r = curl_exec($curl);
            $i++;
        }
        curl_close($curl);
        $res = json_decode($r,true);
    	if($res['s'] == 'OK'){      
			return $res['d'];
		}else{
			return $res['s'];
		}
	}
	/**
	* 回复文本
	*/
	protected function resText($contentStr){
		//$contentStr .= "\n\n回复'999'返回主导航";
		$time = time();
		$resultStr = sprintf($this->resModel['text'], $this->fromUserName, $this->toUserName, $time, 'text', $contentStr);	
		echo $resultStr;exit;
	}
	/**
	* 回复图文
	*/
	protected function resNews($contentarr,$url = ''){
		//$contentarr为存储新闻的数组
		$mess = '';
		if($url != ''){
			$count = 1;
			$mess = "<item>
                    <Title><![CDATA[".$contentarr['title']."]]></Title>
                    <Description><![CDATA[".$contentarr['title']."]]></Description>
                    <PicUrl><![CDATA[http://".$this->cdn."/".$contentarr['pic']."]]></PicUrl>
                    <Url><![CDATA[".$url."]]></Url>
                    </item>";
		}else{
		$count = count($contentarr);
		foreach($contentarr as $k=>$v){
			$mess .= "<item>
					<Title><![CDATA[".$v['title']."]]></Title>
					<Description><![CDATA[".$v['title']."]]></Description>
					<PicUrl><![CDATA[http://".$this->cdn."/".$v['extra']."]]></PicUrl>
					<Url><![CDATA[http://".$this->cdn."/index.php?r=show/article&id=".$v['id']."]]></Url>
					</item>";	
		}
		}
		$time=time();
		$resultStr = sprintf($this->resModel['news'], $this->fromUserName, $this->toUserName, $time, 'news', $count, $mess);
        echo $resultStr;exit;
	}
	/**
	 * 错误跳转
	 */
	protected function errorJump($error,$jumpUrl = '',$params = array()){
		$params = array(
			'error' => $error,
			'jumpUrl' => !empty($jumpUrl) ? $this->createUrl($jumpUrl,$params) : 'javascript:history.back(-1);',
			'waitSecond' => 3,
		);
		$this->render('jump',$params);		
		exit();
	}

	/**
	 * 成功跳转
	 */
	protected function successJump($message,$jumpUrl,$params = array()){
		$params = array(
			'message' => $message,
			'jumpUrl' => !empty($jumpUrl) ? $this->createUrl($jumpUrl,$params) : $_SERVER["HTTP_REFERER"],
			'waitSecond' => 1,
		);
		$this->render('jump',$params);
		exit();
	}
	/**
	* session 控制
	*/
	/*public function filterAccessControl($filterChain)
    {
       if($this->session['admin'] == ''){
            $this->redirect(array('admin/home/index'));
        } 
        $filterChain->run();
	}*/
	/**
	* 微信浏览器浏览控制
	*/
	public function filterBrowserControl($filterChain){
		if(!preg_match("/MicroMessenger/i",$_SERVER["HTTP_USER_AGENT"])){
    		echo "非法请求！";exit;
		}
		$filterChain->run();	
	}
	// 加密
	public function encrypt($key, $plain_text) {  
    	$plain_text = trim($plain_text);  
    	$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));  
    	$c_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $plain_text, MCRYPT_ENCRYPT, $iv);  
   	    return trim(chop(base64_encode($c_t)));  
	}
	//解密	
	public function decrypt($key, $c_t) {  
    	$c_t = trim(chop(base64_decode($c_t)));  
    	$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));  
    	$p_t = mcrypt_cfb (MCRYPT_CAST_256, $key, $c_t, MCRYPT_DECRYPT, $iv);  
    	return trim(chop($p_t));  
	}

		
}
