<?php
/**
* ShowController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-02-17 - created
* 
*/
class ShowController extends Controller{
	/**
	* 新闻显示主页
	*/
	public function actionIndex(){
		$news_type = NewsType::model();
        $type = $news_type->findAll();
		$news = array();

        $newsModel = new News();    
        foreach($type as $v){
			//获取相应文章
            $sql = "select * from play_news where type = '".$v['id']."' order by id DESC limit 0,5";
            $news[$v['id']]=$newsModel->findAllBySql($sql);
        }
        $this->headerfilter();
		$this->renderPartial('index',array(
                'type'=>$type,
                'news'=>$news,
            ));
	}

	/**
	* 新闻列表页
	*/
	public function actionList($id){
		$newsModel = News::model();
		$sql = "select id,title,time from play_news where type = '".$id."'";
		$news_list = $newsModel->findAllBySql($sql);
        $this->headerfilter();
		$this->renderPartial("list",array(
			"list"=>$news_list,
		));	
	}

	/**
	* 新闻内容页
	*/
	public function actionArticle($id){
		$newsModel = News::model();
		$news = $newsModel->findByPk($id);
        $this->headerfilter();
		$this->renderPartial('article',array('news'=>$news));
	}
	
	/**
	* header返回超时时间
	*/
	public function headerfilter(){
		//定义缓冲时间，可修改
		$offset = 3600*24;
		//转换成GMT时间
		$expire = "Expires:".gmdate("D,d M Y H:i:s", time() + $offset)." GMT";	
		$cache_control = "Cache-Control:max-age=3600";
		//输出 HTTP header
		Header($expire);		
		Header($cache_control);
	}

	/**
	* 浏览器控制
	*/
	public function filters(){
		return array(
			'BrowserControl',
		);
	}
}
