<?php 
namespace Admin\Controller;
use Think\Controller;

class AuthController extends Controller{

	//列表展示
	public function showlist()
	{
		$authinfo = D('Auth')->order('auth_path asc')->select();
		
		//面包屑
		$bread = array(
				'first'=>'权限管理',
				'second'=>'权限列表',
				'sendTo'=>array(
					'【添加权限】',U('Auth/add'),
					),
			);

		$this->assign('bread',$bread);
		$this->assign('authinfo',$authinfo);
		$this->display();
	}


}



?>