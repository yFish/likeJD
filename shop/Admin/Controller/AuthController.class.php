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



	##添加权限
	public function add()
	{	
		//展示 收集 两个逻辑
		
		//收集
		if(IS_POST)
		{	
			//添加
			$authModel = new \Admin\Model\AuthModel();
			$data = $authModel->create();
			if($authModel->add($data))
			{
				$this->success('权限添加成功',U('showlist'),2);
			}
			else
			{
				$this->error('权限添加失败',U('add'),2);
			}
		}
		else
		{	

			//展示
			$ainfo = D('Auth')->where('auth_level in'.'(0,1)')->order('auth_path')->select();

			//面包屑现示
			//面包屑
			$bread = array(
				'first'=>'权限管理',
				'second'=>'权限添加',
				'sendTo'=>array(
					'【返回】',U('Auth/showlist'),
					),
			);

			$this->assign('bread',$bread);
			$this->assign('ainfo',$ainfo);
			$this->display();
		}
	}
		
}



?>