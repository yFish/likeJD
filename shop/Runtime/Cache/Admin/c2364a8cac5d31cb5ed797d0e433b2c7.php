<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<style>
    
    #table_1 tr {
         text-align: center;
    }
</style>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("COMMON_URL")); ?>js/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：<?php echo ($bread['first']); ?>-》<?php echo ($bread['second']); ?></span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo ($bread['sendTo'][1]); ?>"><?php echo ($bread['sendTo'][0]); ?></a>
                </span>
            </span>
        </div>
        <div></div>

        
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
                        <td><input type="text" name="goods_name" /></td>
                    </tr>               
                    <tr>
                        <td>商品价格:</td>
                        <td><input type="text" name="goods_price" /></td>
                    </tr>
                    <tr>
                        <td>商品logo图片:</td>
                        <td>
                            <input type="file" name="goods_logo"  id="goods_logo"/>
                            <div id="goods_logo_id">
                                <img  alt="" id='imgShow' height='120'/>
                            </div>
                        </td>
                    </tr>
                    <script>
                            $(function(){
                            new uploadPreview({ UpBtn: "goods_logo", DivShow: "goods_logo_id", ImgShow: "imgShow" });
                            });

                    </script>
                </table>
                <table border="1" width="100%" class="table_a" id="detail-tab-tb" style="display:none">
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea name="goods_introduce" id="goods_introduce" style="width:730px;height:200px;" ></textarea>
                    </td>
                </tr>
                    <script>
                         var ue = UE.getEditor('goods_introduce');
                    </script>
                </table>

                <table border="1" width="100%" class="table_a" id="mix-tab-tb"  style="display:none">
                <tr>
                    <td>其他信息</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>
                </table>

                <table border="1" width="100%" class="table_a" id="properties-tab-tb" style="display:none">
                <tr>
                    <td>商品重量</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr> 
                </table>

                <table border="1" width="100%" class="table_a" id="gallery-tab-tb" style="display:none">
                <script>
                        var  p_num = 1;  //设置添加节点的计数器  改变ID
                        function add_item()
                        {   

                            //点击添加上传图片框
                            var s ="<tr><td><span style='cursor: pointer' onclick='$(this).parent().parent().remove();'>[-]</span>商品相册</td><td><input type='file' name='goods_pics[]' id='goods_pics_" + p_num +"'  /><div id='goods_pics_div_"+ p_num +"'><img  alt='' id='goods_pics_img_"+ p_num +"' width='150'   /></div></td></tr>";
                            
                            $('#gallery-tab-tb').append(s); 

                            new uploadPreview({ UpBtn: "goods_pics_"+p_num, DivShow: "goods_pics_div_"+p_num, ImgShow: "goods_pics_img_"+p_num });
                          

                            p_num++;
                        }

                        // //点击删除添加框    
                        // function clear_tr()
                        // {
                        //     $('#clear_tr').remove();
                        // }
                  
                </script>
                <tr>
                    <td><span style='cursor: pointer' onclick='add_item(); '>[+]</span>商品相册</td>

                    <td>
                        <input type='file' name='goods_pics[]' id='goods_pics_0' />
                        <div id='goods_pics_div_0'>
                            <img  alt='' id='goods_pics_img_0' width='150'/>
                        </div>
                    </td>
                </tr>  
                        <script>
                            $(function(){

                                new uploadPreview({ UpBtn: "goods_pics_0", DivShow: "goods_pics_div_0", ImgShow: "goods_pics_img_0" });
                            });
                        </script>
                </table>
                
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
                <p style="margin-left: 360px"><input type="submit" value="添加">&nbsp;<input type="reset" value="重置"></p>
          
           
            </form>
        </div>


    </body>
</html>