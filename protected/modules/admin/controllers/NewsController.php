<?php
/**
* NewsController.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-11 - created
* 
*/
class NewsController extends Controller{
	/**
	* 新闻列表
	*/
	public function actionIndex(){
		$sql = "select n.id,n.title,n.content,n.time,t.name,n.extra,n.mark from play_news as n left join play_news_type as t on n.type = t.id order by n.id DESC";
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
                'news'=>$posts, 
                'pages'=>$pages, 
        ));
		exit;
		$news = News::model();
		$newsAll = $news->findAll();
		$this->render('index',array(
			'news'=>$newsAll,
		));
	}
	/*
	* 新闻分类
	*/
	public function actionType(){
		$news_type = NewsType::model();
		$type = $news_type->findAll();
		$this->render('type',array(
			'type'=>$type,
		));
	}
	/*
	* add type
	*/
	public function actionAddType(){
		$this->render("add_type");
	}
	/**
	* 添加新闻类型验证
	*/
	public function actionDoAddType(){
		$news_type = new NewsType();
		$news_type->name = trim($_POST['name']);
		$news_type->type_desc = trim($_POST['type_desc']);
		$news_type->insert();
		$this->successJump('添加类型成功！','news/type');
	}
	/**
	* edit news type
	*/
	public function actionEditType($id){
		$newsTypeModel = NewsType::model();
        $newsType = $newsTypeModel->findByPk($id);	
		$this->render("edit_type",array(
			'type'=>$newsType,
		));
	}
	/**
	* do edit type 
	*/
	public function actionDoEditType(){
		$id        = empty($_POST['id'])?'':trim(addslashes($_POST['id']));
		$name      = empty($_POST['id'])?'':trim(addslashes($_POST['name']));
		$type_desc = empty($_POST['type_desc'])?'':trim(addslashes($_POST['type_desc']));

		$newsTypeModel = NewsType::model()->findByPk($id);
		$newsTypeModel->name = $name;
		$newsTypeModel->type_desc = $type_desc;
		$res = $newsTypeModel->update();
		if($res == 1){
			$this->successJump("修改类型成功",'news/type');
		}else{
			$this->errorJump("修改失败。。");
		}
	}
	/**
	* del type
	*/
	public function actionDelType($id){
		if(empty($id)){
            $this->errorJump("参数错误");
        }
        $newsTypeModel = new NewsType();
        $newsTypeModel->deleteByPk($id);
        $this->successJump("删除成功",'news/type');	
	}
	/*
	* add news
	*/
	public function actionAdd(){
		$news_type = NewsType::model();
		$type = $news_type->findAll();
		$this->render("add",array(
			'type'=>$type,
		));
	}
	/**
	* 添加新闻验证
	*/
	public function actionDoAdd(){
		if(empty($_POST['title']) || empty($_POST['type'])){
			$this->errorJump('标题、文章类型均不能为空','news/add');
		}
		//获取上传的图片
		//echo "<pre>";
		//print_r($_FILES);
		//echo "</pre>";exit;
		$pic = $_FILES['w_pic'];
		if(!empty($pic)){
			if(is_uploaded_file($pic['tmp_name'])){
				//把文件转存到你希望的目录
				$uploaded_file=$pic['tmp_name'];

				$user_path=$_SERVER['DOCUMENT_ROOT']."/uploads";

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
		$news = new News();
		$news->title   = $_POST['title'];
		$news->url 	   = $_POST['url']; 
		//将域名改为cdn域名
		$content_y = empty($_POST['myContent'])?'':$_POST['myContent'];
		$content 	   = str_replace($this->domain,$this->cdn,$content_y);
		$news->content = $content; 
		//$news->content = $_POST['myContent'];
		$news->time    = time();
		$news->type    = $_POST['type'];
		if(!empty($pic)){
			$news->extra   = "uploads".$b_pic_locaion;
		}else{
			$news->extra   = "";
		}
		$news->mark    = $_POST['mark'];
		$news->insert();
		$this->successJump('发布成功！','news/index'); 	
		exit;
	}
	/**
	* 删除新闻
	*/
	public function actionDelNews($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}
		$newsModel = new News();
		$newsModel->deleteByPk($id);
		$this->successJump("删除成功",'news/index');
	}
	/**
	* 编辑新闻
	*/
	public function actionEditNews($id){
		if(empty($id)){
			$this->errorJump("参数错误");
		}
		$newsModel = News::model();
		$news = $newsModel->findByPk($id);
		$news_type = NewsType::model();
        $type = $news_type->findAll();
		$this->render("editnews",array(
						'news'=>$news,
						'type'=>$type,	
					));
	}
	/**
	* 修改新闻验证
	*/
	public function actionDoEditNews(){
		if(empty($_POST['id']) || empty($_POST['title']) || empty($_POST['type'])){
            $this->errorJump('标题、内容和文章类型均不能为空','news/add');
        }
		$id = $_POST['id'];
        $pic = $_FILES['w_pic'];
        $b_pic_locaion = '';
		if(!empty($pic['tmp_name'])){
            if(is_uploaded_file($pic['tmp_name'])){
                //把文件转存到你希望的目录
                $uploaded_file=$pic['tmp_name'];

                $user_path=$_SERVER['DOCUMENT_ROOT']."/uploads";

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

		$news = News::model()->findByPk($id);
        $news->title = $_POST['title'];
		$news->url = $_POST['url'];
		$content = empty($_POST['myContent'])?'':$_POST['myContent'];
        $news->content = $content;
        //$news->time = time();
        $news->type = $_POST['type'];
		if(!empty($pic['tmp_name'])){
            $news->extra   = "uploads".$b_pic_locaion;
        }
		$news->mark = $_POST['mark'];
        $news->update();
        $this->successJump('修改成功！','news/index');
        exit;	
	}
	/**
    * session控制filter
    */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
}
