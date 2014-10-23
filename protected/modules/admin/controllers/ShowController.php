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
		
		foreach($type as $v){
			//获取相应文章
			//$news[$v['id']]	= News::model();
		}
		exit;
		$this->rander('index');
	}
	/**
	* 新闻内容页
	*/
	public function actionArticle($id){
		$newsModel = News::model();
		$news = $newsModel->findByPk($id);
		//echo "<pre>";
		//print_r($news);
		//echo "</pre>";exit;
		$this->randerPartial();
	}
}
