<?php 
namespace Admin\Model;
use Think\Model;

class AuthModel extends Model{

	## 插入数据成功后回调方法
	protected  function _after_insert($data,$options)
	{
		 //维护两个字段,根据 auth_path / auth_level
		 //1. 根据auth_pid 判断 auth_path
			//path有两种情况  顶级路径  与次顶级路径	
				
				if($data['auth_pid']==0)
				{  //当auth_pid ==0 的时候,他就是顶级路径   路径就等于 auth_id
					$path = $data['auth_id'];
				}
				else
				{	
					//非顶级路径  父记路径+auth_id值
					$pinfo = $this->field('auth_path')->find($data['auth_pid']);
					$ppt  = $pinfo['auth_path'];
					$path = $ppt.'-'.$data['auth_id'];
				}
				
				$level = substr_count($path,'-');

				$this->save(array('auth_id'=>$data['auth_id'],'auth_path'=>$path,'auth_level'=>$level));

		 //2. 根据auth_pid 判断 auth_level
	}

}



?>