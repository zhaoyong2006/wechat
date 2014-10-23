<?php 
$gController  = $this->getId();
$gAction    = $this->getAction()->getId();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/my.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">WECHAT</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php foreach($this->menu as $key => $value){?>
            <?php if($gController == $value['control']){?>
            <li class="active dropdown">
            <?php }else{?>
            <li class="dropdown">
            <?php }?>
              <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->createUrl($value['control'].'/'.$value['action']);?>"><?php echo $value['name'];?><b class="caret"></b></a>
        		<ul class="dropdown-menu">
                <?php foreach($value['sub'] as $k => $v){?>
					<li><a href="<?php echo $this->createUrl( $v['control'].'/'.$v['action']);?>"><?php echo $v['name'];?></a></li>
				<?php }?>
                </ul>
		    </li>
            <?php }?>
            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session['admin'];?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->createUrl('home/doLogout');?>">退出</a></li>
                            </ul>
                        </li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" style="padding-top:70px">

      <div class="row">
     <?php if($gController != 'home'){?>
        <div class="col-md-2">
        <div class="bs-sidebar hidden-print affix" style="width:180px">
          <ul class="nav nav-pills nav-stacked">
          <li><a href="javascript:history.back(-1);">返回<span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
          <?php if($gAction == 'index'){?>
          <li class="active">
          <?php }else{?>
          <li>
          <?php }?>
          <a href="<?php echo $this->createUrl($gController.'/index');?>"><?php echo $this->menu[$gController]['name'];?><span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
          </li>
          <?php foreach($this->menu[$gController]['sub'] as $value){?>
          <?php if($gAction != $value['action']){?>
          <li class="active">
          <?php }else{?>
          <li>
          <?php }?>
            <a href="<?php echo $this->createUrl($value['control'].'/'.$value['action']);?>"><?php echo $value['name'];?><span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
          </li>
          <?php }?>
          </ul>
          </div>
              </div>
     <?php }?>  
      <div class="col-md-10">
        <?php echo $content; ?>
      </div>
     
 
        </div><!--row-fluid-->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap.min.js"></script>
  </body>
</html>
