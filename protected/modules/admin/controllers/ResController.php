<?php
//response class
class ResController extends Controller{

	//response type
	public $textRes = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
	public $imageRes = "<xml>
			    <ToUserName><![CDATA[%s]]></ToUserName>
			    <FromUserName><![CDATA[%s]]></FromUserName>
		     	    <CreateTime>%s</CreateTime>
			    <MsgType><![CDATA[%s]]></MsgType>
			    <Image>
		 	    <MediaId><![CDATA[%s]]></MediaId>
			    </Image>
			    </xml>";
	public $voiceRes  = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Voice>
			<MediaId><![CDATA[%s]]></MediaId>
			</Voice>
			</xml>";
	public $newsRes  = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<ArticleCount>%s</ArticleCount>
			<Articles>
			%s
			</Articles>
			</xml>";
	//response function
	public function actionText($contentStr,$fromUserName,$toUserName){
		$time = time();
		//test
		$handle = fopen('error.log','a');
		fwrite($handle,"1111");
		//test end
		$resultStr = sprintf($this->textRes, $fromUserName, $toUserName, $time, 'text', $contentStr);	
		echo $resultStr;exit;
	}
}
?>
