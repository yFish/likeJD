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
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('Admin/Goods/add');?>">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
           
            <table id="tb_1" class="table_a" border="1" width="100%" >
                <tbody>
                    <tr style="font-weight: bold;">
                        <td >序号</td>
                        <td>商品名称</td>
                        <td>库存</td>
                        <td>价格</td>
                        <td>图片</td>
                        <td>缩略图</td>
                        <td>重量</td>
                        <td>创建时间</td>
                        <td  colspan="2">操作</td>
                    </tr>
               <?php if(is_array($goodsinfo)): foreach($goodsinfo as $key=>$g): ?><tr id="product_<?php echo ($g['goods_id']); ?>">
                        <td><?php echo ($g['goods_id']); ?></td>
                        <td><a href="#"><?php echo ($g['goods_name']); ?></a></td>
                        <td>100</td>
                        <td><?php echo ($g['goods_price']); ?></td>
                        <td><img src="/<?php echo (substr($g['goods_big_logo'],2)); ?>" alt="暂无图片" height="100" width="100"></td>
                        <td><img src="/<?php echo (substr($g['goods_small_logo'],2)); ?>" alt="暂无图片" height="60" width="60"></td>
                        <td><?php echo ($g['goods_weight']); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$g['add_time'])); ?></td>
                        <td><a href="<?php echo U('Admin/goods/update',array('goods_id'=>$g['goods_id']));?>">修改</a></td>
                        <td><a href="javascript:;" onclick="if(confirm('确认要删除此商品吗?')){del_goods(<?php echo ($g['goods_id']); ?>)};">删除</a></td>
                    </tr><?php endforeach; endif; ?>
                    <script>    
                                function del_goods(goods_id){
                                        $.ajax({
                                              url:"<?php echo U('delGoods');?>",
                                              data:{'goods_id':goods_id}, 
                                              dataType:'json',                                                                  
                                              success:function(msg){
                                                if(msg.rs==1)
                                                {
                                                    $('#product_'+goods_id).remove();
                                                }                               
                                              }
                                             
                                      }); 
                                }
                    </script>
                    <tr>
                        <td colspan="20" style="text-align: center">
                            <?php echo ($pagelist); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>