<?php
/**
 * menu.php
 *
 * Developed by zhaoyong <zhaoyong@playcrab.com>
 * Copyright (c) 2014 www.playcrab.com
 *
 * Changelog:
 * 2014-01-09 - created
 *
 */
return array(
    'news' => array(
        'name'      => '新闻管理',
        'control'   => 'news',
        'action'    => 'index',
        'sub'       => array(
            'news_list'    => array(
                'name'      => '所有新闻',
                'control'   => 'news',
                'action'    => 'index',
            ),
            'news_type'        => array(
                'name'      => '新闻分类',
                'control'   => 'news',
                'action'    => 'type',
            ),
            'news_add'       => array(
                'name'      => '添加新闻',
                'control'   => 'news',
                'action'    => 'add',
            )
        )
    ),
    'integ'   => array(
        'name'      => '积分系统',
        'control'   => 'integ',
        'action'    => 'index',
        'sub'       => array(
            'sign' => array(
                'name'      => '每日签到',
                'control'   => 'integ',
                'action'    => 'sign',
            ),
			'integ_cons' => array(
				'name'      => '积分兑换',
				'control'   => 'integ',
				'action'    => 'cdkeyLog',
			),
			'integ_cdkey' => array(
				'name'      => '礼包设置',
				'control'   => 'integ',
				'action'    => 'cdkey',
			),
			'zhuanpan'   => array(
				'name'      => '大转盘',
				'control'   => 'integ',
				'action'    => 'zhuanpan',
			),
			'platform'    => array(
				'name'      => '平台设置',
				'control'   => 'integ',
				'action'    => 'platform',
			),
        )
    ),
    'market'    => array(
        'name'      => '会员管理',
        'control'   => 'fans',
        'action'    => 'index',
        'sub'       => array(
            'search' => array(
                'name'      => '会员搜索',
                'control'   => 'fans',
                'action'    => 'index',
            )
        )
    ),
	'more'    =>array(
		'name'      => '更多',
		'control'   => 'more',
		'action'    => 'index',
		'sub'       =>array(),
	),
);

