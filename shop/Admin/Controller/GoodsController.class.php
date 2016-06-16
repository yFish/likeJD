<?php 
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {

	##列表展示 
	public function showlist(){
		$goods_model = D('Goods');
		$nowinfo = $goods_model->fetchData(); // 将信息分为两部分返回  分页与所有信息

		//返回的数组数据拆分
		$goodsinfo = $nowinfo['pageinfo'];  // 所有信息返回
		$pagelist = $nowinfo['pagelist'];	// 分页信息返回

		

		//拆分现示
		$this->assign('goodsinfo',$goodsinfo); // 所有信息
		$this->assign('pagelist',$pagelist); // 分页信息
		$this->display();
	}	

	##添加商品
	public function add(){
		$goods = D('Goods');

		if(IS_POST)
		{	
			$date = $goods->create();  ##使用create方法创建数据对象的时候会自动完成数据处理。
									   ##因此，在ThinkPHP使用create方法来创建数据对象是更加安全的方式，
									   ##而不是直接通过add或者save方法实现数据写入。

			if($goods->add($date))    ##添加
			{
				$this->success('添加成功',U('showlist'),2);  ##成后跳转
			}
			else
			{
				$this->error('添加失败',U('add'),2);		##失败跳转	
			}
		}
		else
		{	
			//表单展示
			
			$this->display();
		}
		
	}

	##修改商品
	public function update(){
		//同样是两个逻辑 
		
		$goods_id = I('get.goods_id');    //接收要修改的ID
		$goods_model = D('Goods');
		
		//信息收集
		if(IS_POST)
		{
			$data = $goods_model->create();   
			if($goods_model->save($data))
			{
				$this->success('修改成功',U('showlist'),2);
			}
			else
			{
				$this->error('修改失败',U('update',array('goods_id'=>$goods_id)),2);
			}
		}
		else
		{	
			//信息展示, 
			$goodsinfo = $goods_model->find($goods_id);

			//取相册信息  查goods_pics表  id 为goods_modelid 多条数据  数组的方式
			$imginfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();

			if(!empty($imginfo))
			{
				$this->assign('imginfo',$imginfo);  ## 查询结果不为空时, 渲染到模板
			}
			
			$this->assign('goodsinfo',$goodsinfo);
			$this->display();
		}
		
	}


	##删除商品
	public function delGoods(){

		$goods_id = I('goods_id');
		$goodsModel = D('Goods');
		
		$rs = $goodsModel->where('goods_id='.$goods_id)->setField('is_del','删除');
		if($rs)
		{
			echo json_encode(array('rs'=>1));   //成功
		}
		else
		{
			echo json_encode(array('rs'=>2));   //失败
		}
		
	}

	##删除单个商品相册	
	public function delImg(){
		//接收删除ID
		$img_id = I('img_id');
		
		//删除本地物理图片
		$PiscInfo = D('GoodsPics')->find($img_id);
			unlink($PiscInfo['pics_gig']);
			unlink($PiscInfo['pics_small']);
	   
		//删除数据库地址信息
		$info = D('GoodsPics')->delete($img_id);  // 1 返回删除记录条数
		if($info)
		{
			echo '删除成功';
		}

	}

}

?>