<?php 
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model{

	//更新数据前的回调方法
    protected function _before_update(&$data,$options) {	
    	
    	if($_POST['now_act']=='提交分配')
    	{	
    		//维护两个数据  //role ids   role_auth_ac
    		//1,制作role_ids
    		$data['role_auth_ids'] = implode(',',$_POST['role_auth_ids']);
    		
    		//2, 制作 role_auth_ac						//in 数据 用括号包含 否则不识别
    		$datainfo = D('Auth')->where("auth_id in ({$data[role_auth_ids]})")->select();
    		
    		//3,  根据$datainfo 循环出 auth_a  auth_c  实现数据拼接
    		$s = '';
    		foreach($datainfo as $k=>$v)
    		{	
    			if(!empty($v['auth_c']) && !empty($v['auth_a']))
    			{
    				$s.=$v['auth_c'].'-'.$v['auth_a'].',';
    			}   			
    		}   			
    			$s = rtrim($s,',');
    			$data['role_auth_ac'] = $s;
    	}
    }	
}



