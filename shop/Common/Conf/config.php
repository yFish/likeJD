<?php
return array(

    /*设置配置路径  引入富文本编辑器*/
    'PLUGIN_URL'=>'/Plugin/',

    /*给COMMON定义访问路径*/
    'COMMON_URL'=>'/Common/',
	
    //定义网站的地址域名(可以方便图片的现示)
    'SELF_URL'  => 'dj.com',
    //打开页面跟踪信息
    'SHOW_PAGE_TRACE' =>true,

    /*数据库配置*/

	'DB_TYPE'               =>  'mysql',    	 // 数据库类型
    'DB_HOST'               =>  'localhost', 	 // 服务器地址
    'DB_NAME'               =>  'dj',            // 数据库名
    'DB_USER'               =>  'root',          // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '',              // 端口
    'DB_PREFIX'             =>  'dj_',    		 // 数据库表前缀
    'DB_PARAMS'          	=>  array(), 		 // 数据库连接参数    
    'DB_DEBUG'  			=>  TRUE, 			 // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        	 // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      	 // 数据库编码默认采用utf8	
);