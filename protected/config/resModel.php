<?php
return array(
	'text' => "<xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <Content><![CDATA[%s]]></Content>
                   <FuncFlag>0</FuncFlag>
                   </xml>",
	'image' =>"<xml>
		   <ToUserName><![CDATA[%s]]></ToUserName>
	           <FromUserName><![CDATA[%s]]></FromUserName>
	     	   <CreateTime>%s</CreateTimei>
	 	   <MsgType><![CDATA[%s]]></MsgType>
		   <Image>
		   <MediaId><![CDATA[%s]]></MediaId>
		   </Image>
		   </xml>",
	'voice' =>"<xml>
		   <ToUserName><![CDATA[%s]]></ToUserName>
	    	   <FromUserName><![CDATA[%s]]></FromUserName>
		   <CreateTime>%s</CreateTime>
		   <MsgType><![CDATA[%s]]></MsgType>
		   <Voice>
		   <MediaId><![CDATA[%s]]></MediaId>
		   </Voice>
		   </xml>",
	'news'  => "<xml>
		    <ToUserName><![CDATA[%s]]></ToUserName>
		    <FromUserName><![CDATA[%s]]></FromUserName>
	    	    <CreateTime>%s</CreateTime>
		    <MsgType><![CDATA[%s]]></MsgType>
		    <ArticleCount>%s</ArticleCount>
		    <Articles>
	    	    %s
	 	    </Articles>
		    </xml>",
);
