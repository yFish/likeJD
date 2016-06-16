<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    
	

	##登陆
	public function login(){
		if(IS_POST)
		{
			var_dump($_POST);
		}
		else
		{
			$this->display();
		}
			
				
			
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



}