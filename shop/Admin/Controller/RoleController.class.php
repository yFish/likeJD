<?php 
namespace Admin\Controller;
use 	Think\Controller;

class RoleController  extends Controller {


	##显示全部角色信息
	public function showlist()
	{
		//获得全部角色信息

		$info = D('Role')->select();
		$bread = array(
			 'first'=>'权限管理',
			 'second'=>'角色列表',
			 'sendTo'=>array(
			 	'【返回】',U("admin/role/add"),
			 	),

			);
		$this->assign('info',$info);
		$this->assign('bread',$bread); //面包屑
		$this->display();
	}


	##分配权限
	public function distribute()
	{			
		$roleModel = D('Role');		
		if(IS_POST)
		{	
			//调用验证方法
			$data = $roleModel->create();
					//通过 瞻前顾后机制 实现数据制作 role_auth_ids / role_auth_ac;
						//控制器只负责调用save()方法, 其余的工作交给model模型完成
			if($roleModel->save())
			{	
				//执行成功 跳转到角色页面
				$this->success('权限分配成功',U('showlist'),2);
			}
			else
			{	
				//分配失败,跳转回distribute页面 同时将role_id 传递回去		
				$this->error('权限分配失败',U('distribute'),array('role_id'=>$_POST['role_id']));
			}
		}
		else
		{
			//获得角色信息
			$role_id = I('get.role_id');
			$roleinfo = $roleModel->where(array('role_id'=>$role_id))->find();

			$this->assign('roleinfo',$roleinfo);

			//根据角色信息 获得被分配的权限信息
			$auth_infoA = D('Auth')->where(array('auth_level'=>0))->select(); //顶级权限
			$auth_infoB = D('Auth')->where(array('auth_level'=>1))->select(); //次顶级权限

			$this->assign('auth_infoA',$auth_infoA);
			$this->assign('auth_infoB',$auth_infoB);	

			//面包屑
			$bread = array(
				'first'=>'权限管理',
				'second'=>'权限分配',
				'sendTo'=>array(
					'【返回】',U('showlist'),
					),
				);

			$this->assign('bread',$bread); //面包屑
			$this->display();
		}
		

	}



}



?>