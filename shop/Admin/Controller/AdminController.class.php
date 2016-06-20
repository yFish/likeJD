<?php
namespace Admin\Controller;
use Common\Tools\BackController;
class AdminController extends BackController {
    
	

	##登陆
	public function login(){
		if(IS_POST)
		{	
			//判断用户名与密码的合法性
			$name = $_POST['admin_user'];
			$pwd = $_POST['admin_psd'];

			//实例化Model对象  管理员表
			$info = D('Manager')->where(array('mg_name'=>$name,'mg_pwd'=>$pwd))->find();
			if($info!=null)
			{
				   // 将用户登录信息   id/name  session持久化
					Session('admin_id',$info['mg_id']);				
					Session('admin_name',$info['mg_name']);

				   //页面跳转
				   $this->redirect('admin/index/index');	
			}
			else
			{	
				//验证失败 跳转回登录页面
				$this->error('用户名或密码错误','login',2);
			}
		}
		else
		{
			$this->display();
		}
						
	}

	##管理员退出系统
	public function logout()
	{	
		//清除session
		session(null);

		//跳转到登陆页
		//$this->redirect(模块/控制器/方法)  相同的模块与控制器 只需要天上方法名就可以
		$this->redirect('login');
	}
	

	##获取验证码
	public function verifyImg()     
	{	$cfg = array(

		'imageH'    =>  30,                 // 验证码图片高度
        'imageW'    =>  110,                // 验证码图片宽度
        'length'    =>  4,               	// 验证码位数
        'fontttf'   =>  '4.ttf',            // 验证码字体，不设置随机获取
        'fontSize'	=> 	15,					// 验证码字体大小
		);
		$very = new \Think\Verify($cfg);
		$very->entry();
	}

	##前台 login.html 调用ajax 检测验证码
	public function checkCode()
	{
		$code = I('get.code');

			$very = new \Think\Verify();
			if($very->check($code))
			{
				echo json_encode(array('res'=>1));   //成功
			}
			else
			{
				echo json_encode(array('res'=>2));   //失败
			}
	}

	##显示用户角色信息
	public function showlist()
	{
		
		//信息收集  信息显示
		// $mangerModel = D('Manager');
		$minfo = D('Manager')->alias('m')->join('LEFT JOIN __ROLE__ r on m.mg_role_id=r.role_id')->field('m.*,r.role_name')->select();

		//面包屑
		$bread = array(
				'first'=>'管理员',
				'second'=>'管理员列表',
				'sendTo'=>array(
					'【添加管理员】',U('Admin/add'),
					),
			);

		$this->assign('minfo',$minfo);
		$this->assign('bread',$bread);
		$this->display();
	}



}