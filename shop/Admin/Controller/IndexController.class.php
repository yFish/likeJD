<?php 
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	
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

		$this->display();
	}

	##右边
	public  function right(){

		$this->display();
	}	

}
?>