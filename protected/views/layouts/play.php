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

	<title><?php echo Yii::app()->name;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="message-container" style="width:100%; top:50px; z-index: 100; position: fixed;display:none;">
      <div class="text-center container" style="width:400px;">
        <div class="alert alert-danger" id="message-alert"></div>
      </div>
    </div>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $this->createUrl("home/main");?>">WECHAT</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php foreach($this->menu as $key => $value){?>
            <?php if($gController == $value['control']){?>
            <li class="active dropdown">
            <?php }else{?>
            <li class="dropdown">
            <?php }?>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $value['name'];?><b class="caret"></b></a>
        		<ul class="dropdown-menu">
                <?php foreach($value['sub'] as $k => $v){?>
					<li><a href="<?php echo $this->createUrl( $v['control'].'/'.$v['action']);?>"><?php echo $v['name'];?></a></li>
				<?php }?>
                </ul>
		    </li>
            <?php }?>
            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name;?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->createUrl('home/doLogout');?>">退出</a></li>
                            </ul>
                        </li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <div class="container" style="padding-top:70px">

      <div class="row">
      <div class="col-md-12">
        <?php echo $content; ?>
      </div>
     
 
        </div><!--row-fluid-->

    </div><!-- /.container -->
 <div id="footer" style="height:100px;">
      <div class="container" style="margin-top:50px;">
        <p class="text-muted">Playcrab </p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<?php if($gAction != 'add'){?>
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/main.js"></script>
<?php }?> 
 </body>
</html>
