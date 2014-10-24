<?php
/**
* _defaults.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-10-24 - created
* 
*/
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	'defaultController'=>'home',
	'charset'=>'utf-8',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('','::1'),
		),
		'admin'=>array(
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/admin/home/index')
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
/*		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=wx_play',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
	),*/
		/*'cache'=>array(
			'class'=>'system.caching.CMemCache',
			'servers'=>array(
				array('host'=>'127.0.0.1','port'=>11211),
			),
		),*/	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		//'adminEmail'=>'webmaster@example.com',
		'token'   => 'weilegexin',
		'resModel'=> include_once(__DIR__.'/resModel.php'),
		'menu'    => include_once(__DIR__.'/menu.php'),
		'guide'   => include_once(__DIR__.'/guide.php'),
		'domain'  => '115.47.16.168',
		'cdn'     => '115.47.16.168:89',
		'lang'    => include_once(__DIR__.'/lang.php'),
		'vip'     => include_once(__DIR__.'/vip.php'),
		'wx_menu' => include_once(__DIR__.'/wx_menu.php'),
		'memConfig'=>array(
			'host' => '127.0.0.1',
			'port' => '11211',
		),
		'dynamicConfigFile' => dirname(__FILE__) . '/local/_settings.php',
	),

);
