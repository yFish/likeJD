<?php 
namespace  Common\Tools; 
use Think\Controller;

//后台继承父类控制器
class BackController extends Controller{

	public function __construct()
	{
		parent::__construct();  //先执行父类构造方法  否则父类的控制器会被覆盖
		
		// 通过session获取管理员id,name
		$admin_id = session('admin_id');
		$admin_name = session('admin_name');	

		//权限控制过滤功能实现
		##CONTROLLER_NAME/ACTION_NAME 系统常量  获得当前控制器与操作方法的名称
		$nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;
		
		//判断用户是否有登陆,非法登陆跳转到登陆页面
		if(!empty($admin_name))    //检测正常登陆   进入控制器判断列
		{		
	 		
	 		//系统某些模块无须设置访问权限,可以直接访问
	 		$allw = 'Admin-logout,Admin-login,Admin-checkCode,Admin-verifyImg,Index-index,Index-left,Index-head,Index-right';
			
			//获得当前管理员对应角色的role__auth_ac信息
			$roleinfo = D('Manager')->alias('m')->join('LEFT JOIN __ROLE__ r on m.mg_role_id=r.role_id')->field('r.role_auth_ac')->where(array('mg_id'=>$admin_id))->find();
			// dump($roleinfo);
			$role_ac = $roleinfo['role_auth_ac'];

			//判断当前用户访问权限是否是角色允许的权限

			//1,判断$roleinfo内有没有包含允许访问的控制器
			//2,判断$allw内有没有包含系统默认所有用户语允许访问的控制器方法
			//3,判断当前用户不是admin(超级管理员)
			//strpos(s1,s2),判断s2在s1首次出现的位置(0/1/2/3)没有出现测返回false
					//当三个条件都满足的时候,弹出退出提示信息
			if(strpos($role_ac,$nowAC)===false && strpos($allw,$nowAC)===false && $admin_name!='admin')
			{		
					##没有访问权限时 提示退出;
					exit('没有访问权限');
			}

		}
		else     //非法登陆,执行跳转
		{	
				//跳转页面需要访问loging,为了防止重定向死循环,需要加入未登录也能正常访问的控制器
				$allo  = 'Admin-login,Admin-checkCode,Admin-verifyImg';
				if(strpos($allo,$nowAC)===false)
				{
					//利用JS来实现freamset全面重定向
					echo $js = '<script>window.top.location = "/index.php/admin/admin/login";</script>';

				}

		}

		

	}

}

?>