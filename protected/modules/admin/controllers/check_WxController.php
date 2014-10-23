<?php
//entry controller
class WxController extends Controller{
	//weixin check
	public function actionEntry($echostr,$signature,$timestamp,$nonce){		
		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			echo $echostr;exit;
		}else{
			exit;
		}
	}
}
