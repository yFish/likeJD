<?php 
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	//构造方法去掉layout模板
	public function __construct()
	{
		parent::__construct();   //执行父类构造方法
		layout(false);   //临时关闭模板
		
	}


	##首页
	public  function index(){

		$this->display();
	}
	

	##头部	
	public  function head(){

		$this->display();
	}


	##左边
	public  function left(){
		//通过 '管理员' 获得对应的'角色'   通过角色获得对应的 '权限' 并显示
		$admin_name = session('admin_name');
		$admin_id  = session('admin_id');

		if($admin_name!=='admin')
		{
			//普通用户登陆信息
			$auth_ids = D('Manager')->alias('m')->join('__ROLE__ r on m.mg_role_id=r.role_id')->field('role_auth_ids')->where(array('m.mg_name'=>$admin_name))->find();

			//取出权限值
			$auth_ids = $auth_ids['role_auth_ids'];

			//根据权限值获得相应的权限信息
			$infoA = D('Auth')->where("auth_id in ($auth_ids) and auth_level=0")->select();  //顶级权限
			$infoB = D('Auth')->where("auth_id in ($auth_ids) and auth_level=1")->select();  //次顶级权限
		}
		else
		{
			//超级管理员用户获得权限   
			$infoA = D('Auth')->where("auth_level=0")->select();  //顶级权限
			$infoB = D('Auth')->where("auth_level=1")->select();  //次顶级权限
		}
		
		
		$this->assign('infoA',$infoA);
		$this->assign('infoB',$infoB);
		$this->display();
	}

	##右边
	public  function right(){

		$this->display();
	}	

}
?>