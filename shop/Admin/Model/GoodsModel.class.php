<?php 
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{

	//自动完成设置add_time / update_time 自动添加
	protected $_auto = array(
			array('add_time','time',1,'function'),  ##自动完成 维护两个字段  1 新增是完成处理
			array('update_time','time',3,'function') ## 3  所有情况都处理   2  更新时处理 
		);


	// 插入数据前的回调方法
	##参数: $data是收集的表单信息
	##		&$data 是引用 传递 函数内部改变值  外边也能访问到		
	##		$options 设置的各种条件
    protected function _before_insert(&$data,$options) {

    	//判断 当有图片上传的时候才来处理业务逻辑 
    	if($_FILES['goods_logo']['error']===0)
    	{
    		//上传图片处理  在上传之前,将上传的图片logo路径等信息收集   
	    	$cfg = array(
	    			'rootPath' => './Common/Uploades/',
	    		);
	    	$up = new \Think\Upload($cfg);  ##实例化对象
	    	$z = $up->uploadOne($_FILES['goods_logo']);  ##uploadeOne 上传单个文件
	    	//$z会返回成功上传附件的相关信息
	    	
	    	//拼装图片的路径信息,存到数据库
	    	$big_path_name = $up->rootPath.$z['savepath'].$z['savename'];
	    	$data['goods_big_logo'] = $big_path_name; 

	    	//根据原图,$big_path_name 制作缩略图
	    	$img = new \Think\Image();  		## 实例化上传类
	    	$img ->open($big_path_name);		## 打开原图
	    	$img->thumb(60,60); 			    ## 制作缩略图

	    	//small_ + 原图名字
	    	$small_path_name = $up->rootPath.$z['savepath'].'small_'.$z['savename']; ## 拼接缩略图路径
	    	$img->save($small_path_name);											 ## 存储缩略图到服务器 
	    	$data['goods_small_logo'] = $small_path_name;							 ## 路径写到数据库	
    	}

    	
    	
    }
    

    // 插入成功后的回调方法
    //$data  没有&  是结尾工作  就不用&了.  不用外部访问

    protected function _after_insert($data,$options) {

    	// 上传图片判断, (只要就一个上传,就往下执行添加)
            $flag = false;

            foreach($_FILES['goods_pics']['error'] as $a =>$b){  ##循环所有上传的商品图片  三维数组
        
                    if($b===0)         ##如有一个上传是成功的,就将状态调成true
                    {
                         $flag = true;
                         break;         ##断点跳出  
                    }
                  }

                    if($flag===true)    ##判断flag 
                    {
        
                      //商品相册图片上传
                        $cfg = array(
                            'rootPath' => './Common/Pics/',
                            );
                        $up = new \Think\Upload($cfg);

                        ##批量上传方式    upload(array('goods_pics'=>$_POST['pics']))
                        $z = $up->upload(array('goods_pics'=>$_FILES['goods_pics']));
                        //通过返回值$z可以看到对应上传OK的相关信息
                        


                        //遍历$z 获得每个附件的信息  存储到数据表中 goods_pics
                        foreach ($z as $k=>$v)
                        {
                            $pics_big_name = $up->rootPath.$v['savepath'].$v['savename']; ##h获取信息
                            
                            //*************根据大图制作小图**************//
                            $img = new \Think\Image();                                              ##实例化
                            $img->open($pics_big_name);                                             ##打开原图
                            $img->thumb(60,60);                                                     ##制作缩略图
                            $pics_small_name = $up->rootPath.$v['savepath'].'small_'.$v['savename'];##缩略图名字 small_+ 大图
                            //goods_id,pics_big,pics_small
                            $img->save($pics_small_name);
                            //*************根据大图制作小图**************//
                            
                            //goods_id, pics_big, pics_small  对应goods_pics的表字段, 循环生生 并存入路径

                            $arr = array(
                                    'goods_id' => $data['goods_id'],      ##字段名id 
                                    'pics_gig' => $pics_big_name,         ##字段名pics_gig 
                                    'pics_small' => $pics_small_name,     ##字段名pics_small   
                                    );
                            //实现相册存储 
                            D('GoodsPics')->add($arr);

                        }

                    }

    }

    //给后台获取商品信息  有 '分页' 要求
    public function fetchData(){
        
        // 1. 获取所有信息
        $total = $this->count();
        $per = 2;

        // 2. 实例化分页的工具类
        $page = new \Common\Tools\Page($total,$per);  ##一定记得要传递参数 总条数和每页显示的条数

        // 3. 获取分页信息 (所有数据)
        $pageinfo = $this->where(array('is_del'=>'不删除'))->order('goods_id desc')->limit($page->offset,$per)->select();      

        // 4. 获取分页列表 (page->fpage()); 
        $pagelist = $page->fpage(array(3,4,5,6,7,8));

        return array(
                'pageinfo'=>$pageinfo,
                'pagelist'=>$pagelist,
            );

    }

    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {

        /******************************LOGO图片更新处理********************************/
        // 1. 判断是否有上传图片 并作出相应的处理
        if($_FILES['goods_logo_update']['error']===0)
        {
            // 2. 删除原有的物理文件
            $logoinfo = $this->field('goods_big_logo,goods_small_logo')->find($options['where']['goods_id']);
            if(!empty($logoinfo['goods_big_logo'])||!empty($logiinfo['goods_small_logo']))
            {   
                unlink($logoinfo['goods_big_logo']);
                unlink($logoinfo['goods_small_logo']);
            }

            //上传图片处理  在上传之前,将上传的图片logo路径等信息收集   
           
            // 3. 创建新logo缩略图

            //上传图片
                //初始化路径
                $cfg = array(

                        'rootPath'=> './Common/Uploades/', 
                    );
                $up = new \Think\Upload($cfg);   ##实例化上传类 参数为上传路径
                $z  =  $up->uploadOne($_FILES['goods_logo_update']);
                
            //图片的路径信息存入数据库
                $big_logo_name = $up->rootPath.$z['savepath'].$z['savename'];
                $data['goods_big_logo'] = $big_logo_name;


            //根据原图制作缩略图
                $img = new \Think\Image();          ## 实例化类
                $img->open($big_logo_name);;        ## 获取原图
                $img->thumb(60,60);                 ## 制作缩略图

            //拼接路径  上传地址到服务器
                $small_logo_name = $up->rootPath.$z['savepath'].'small_'.$z['savename'];
                $img->save($small_logo_name);
                $data['goods_small_logo'] = $small_logo_name;   
        }

        /****************************** end LOGO图片更新处理********************************/

        

        /******************************商品相册图片更新处理********************************/
            //判断是否有图片上传
            $flag = false;
            foreach($_FILES['goods_pics_upload']['error'] as $a=>$b)
            {
                    if($b===0)
                    {
                        $flag = true;
                        break;
                    }
            }

            if($flag === true)
            {   
                $cfg = array('rootPath'=> './Common/Pics/');
                // 1, 实例化上传类  执行上传
                $up = new \Think\Upload($cfg);
                $z = $up->upload(array('goods_pics_upload'=>$_FILES['goods_pics_upload']));
                    foreach($z as $k=>$v)
                    {
                        $pics_big_name = $up->rootPath.$v['savepath'].$v['savename']; ## 获取大图路径信息
                       // 2, 根据大图制作缩略图
                        // 实例化图像处理类
                         $img = new \Think\Image();
                         $img->open($pics_big_name);               
                         $img->thumb(60,60);
                         //获取小图路径信息
                         $pics_small_name = $up->rootPath.$v['savepath'].'small_'.$v['savename'];
                         $img->save($pics_small_name); 
                         // .3 将图片信息上传到数据库
                        
                        $arr = array(
                               'goods_id'=>$options['where']['goods_id'],
                               'pics_gig'=>$pics_big_name,
                               'pics_small'=>$pics_small_name, 
                            );
                        D('GoodsPics')->add($arr);
                    }                          
            }
    
        /******************************end 商品相册图片更新处理********************************/
    }
    // 更新成功后的回调方法
    protected function _after_update($data,$options) {


    }

}



