<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
         <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.config.js"></script>
            <script>
                UEDITOR_CONFIG.toolbars = [[
                     'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|'
                ]];   
             </script>
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/ueditor.all.min.js"> </script>
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("PLUGIN_URL")); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("COMMON_URL")); ?>js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("COMMON_URL")); ?>js/uploadPreview.js"></script>
</head>
<script>
    $(function(){

        $('#tabbar-div span').click(function(){
            $('#tabbar-div span').attr('class','tab-back');  //清除所有class
            $(this).attr('class','tab-front');               //给当前元素加class


            $('.table_a').hide();               //隐藏所有元素
            var hid = $(this).attr('id');       //ID相同的保存
            $('#'+ hid +'-tb').show();          //拼接不同 然后显示 
        });

    });
</script>
<style>
    #tabbar-div {
    background: #80bdcb none repeat scroll 0 0;
    height: 22px;
    padding-left: 10px;
    padding-top: 1px;
    }
    #tabbar-div p {
        margin: 2px 0 0;
    }
    .tab-front {
    background: #bbdde5 none repeat scroll 0 0;
    border-right: 2px solid #278296;
    cursor: pointer;
    font-weight: bold;
    line-height: 20px;
    padding: 4px 15px 4px 18px;
    }
    .tab-back {
        border-right: 1px solid #fff;
        color: #fff;
        cursor: pointer;
        line-height: 20px;
        padding: 4px 15px 4px 18px;
    }
    .tab-hover {
    background: #94c9d3 none repeat scroll 0 0;
    border-right: 1px solid #fff;
    color: #fff;
    cursor: pointer;
    line-height: 20px;
    padding: 4px 15px 4px 18px;
    }
</style>
    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('Admin/goods/showlist');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div id="tabbar-div">
            <p>
            <span id="general-tab" class="tab-front">通用信息</span>
            <span id="detail-tab" class="tab-back">详细描述</span>
            <span id="mix-tab" class="tab-back">其他信息</span>
            <span id="properties-tab" class="tab-back">商品属性</span>
            <span id="gallery-tab" class="tab-back">商品相册</span>
            <span id="linkgoods-tab" class="tab-back">关联商品</span>
            <span id="groupgoods-tab" class="tab-back">配件</span>
            <span id="article-tab" class="tab-back">关联文章</span>
            </p>
        </div>
        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data" id="addForm">
               <table border="1" width="100%" class="table_a" id="general-tab-tb">
                    <tr>
                        <td>商品名称:</td>
                        <td><input type="text" name="goods_name" value="<?php echo ($goodsinfo['goods_name']); ?>" /></td>
                    </tr>               
                    <tr>
                        <td>商品价格:</td>
                        <td><input type="text" name="goods_price" value="<?php echo ($goodsinfo['goods_price']); ?>" /></td>
                    </tr>
                    <tr>
                        <td>商品logo图片:</td>
                        <td>
                                <input type="file" name="goods_logo_update" />
                            <?php if(!empty($goodsinfo['goods_big_logo'])): ?><img src="<?php echo (substr($goodsinfo['goods_big_logo'],1)); ?>"  height="200px" alt="" />
                                <span style="color: red">如果选择上传新的logo图片,则会覆盖旧的logo图片</span><?php endif; ?>
                        </td>
                       
                    </tr>
                </table>
                <table border="1" width="100%" class="table_a" id="detail-tab-tb" style="display:none">
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_introduce" id="goods_introduce" style="width:730px;height:200px;" >
                            <?php echo ($goodsinfo['goods_introduce']); ?>
                        </textarea>
                    </td>
                </tr>
                    <script>
                         var ue = UE.getEditor('goods_introduce');
                    </script>
                </table>

                <table border="1" width="100%" class="table_a" id="mix-tab-tb"  style="display:none">
                <tr>
                    <td>其他信息</td>
                    <td><input type="text" name="goods_weight"  value="<?php echo ($goodsinfo['goods_weight']); ?>"/></td>
                </tr>
                </table>

                <table border="1" width="100%" class="table_a" id="properties-tab-tb" style="display:none">
                <tr>
                    <td>商品重量</td>
                    <td><input type="text" name="goods_weight" value="<?php echo ($goodsinfo['goods_weight']); ?>" /></td>
                </tr> 
                </table>

                <table border="1" width="100%" class="table_a" id="gallery-tab-tb" style="display:none">
                <script>
                    
                        var p_num = 1;
                        function add_item()
                        {                        
                            //点击添加上传图片框
                            var s ="<tr><td><span style='cursor: pointer' onclick='$(this).parent().parent().remove();'>[-]</span>商品相册</td><td><input type='file' name='goods_pics_upload[]' id='goods_pics_upload_"+ p_num +"' /><div id='goods_pics_up_div_"+ p_num +"'><img  alt='' id='goods_img_"+ p_num +"' height='150' /></div></td>";

                            $('#gallery-tab-tb').append(s); 

                            //new 立即显示图片类
                            new uploadPreview({ UpBtn: "goods_pics_upload_"+ p_num , DivShow: "goods_pics_up_div_" + p_num, ImgShow: "goods_img_" + p_num });

                            p_num++;

                        }


                        //点击删除图片信息  ajax 异步 操作数据库
                        function img_del(img_id)
                        {
                            $.ajax({
                                url:"<?php echo U('delImg');?>",       //执行url 因为是同一个控制器 所以U:函数只需要写方法名
                                data:{'img_id':img_id},     //参数   将ID 作为参数 传递过去
                                success: function(msg){     
                                   alert(msg);              //回调
                                   $('#img'+img_id).remove();  // 删除页面 li,实现实时更新数据
                                },

                            });
                        }
                </script>
                <tr>
                    <?php if(!empty($imginfo)): ?><td colspan="100">
                            <ul>
            <?php if(is_array($imginfo)): foreach($imginfo as $key=>$v): ?><li style="float: left; list-style:none;" id="img<?php echo ($v['id']); ?>">
                <span style="cursor: pointer;" onclick="if(confirm('确定要删除这张图片吗?')){img_del(<?php echo ($v['id']); ?>)}">[x]</span>
                <img style="height:100px; width: 100px;" src="<?php echo (substr($v['pics_gig'],1)); ?>" alt="" />
            </li><?php endforeach; endif; ?>
                            </ul>
                        </td><?php endif; ?>
                </tr>
                <tr>
                    <td><span style='cursor: pointer' onclick='add_item();'>[+]</span>商品相册</td>
                    <td>
                        <input type='file' name='goods_pics_upload[]' id='goods_pics_upload_0' />
                        <div id='goods_pics_up_div_0'>
                            <img  alt='' id='goods_img_0' height='150' />
                        </div>
                    </td>
                </tr>  
                
                </table>
                <script>
                    $(function(){
                        new uploadPreview({ UpBtn: "goods_pics_upload_0", DivShow: "goods_pics_up_div_0", ImgShow: "goods_img_0" });    
                    });
                </script>
                
                <table border="1" width="100%" class="table_a" id="linkgoods-tab-tb" style="display:none">
                <tr>
                    <td>关联商品</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>   
                </table>

                <table border="1" width="100%" class="table_a" id="groupgoods-tab-tb" style="display:none">
                <tr>
                    <td>配件</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>   
                </table>

                <table border="1" width="100%" class="table_a" id="article-tab-tb" style="display:none">
                <tr>
                    <td>关联文章</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>   
                </table>
                <input type="hidden" value="<?php echo ($goodsinfo['goods_id']); ?>" name="goods_id">
                <p style="margin-left: 450px"><input type="submit" value="修改"></p>          
            </form>
        </div>
    </body>
</html>