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

        <div style="font-size: 13px; margin: 10px 5px;">
   
    <table id="tb_1" class="table_a" border="1" width="100%" >
        <tbody>
            <tr style="font-weight: bold;">
                <td>ID序号</td>
                <td>名称</td>
                <td>登记时间</td>
                <td>角色</td>
                <td  colspan="3">操作</td>
            </tr>
       <?php if(is_array($minfo)): foreach($minfo as $key=>$g): ?><tr id="product_<?php echo ($g['mg_id']); ?>">
                <td><?php echo ($g['mg_id']); ?></td>                                    
                <td><a href='javascript:;'><?php echo ($g['mg_name']); ?></a></td>                                    
                <td><?php echo (date('Y-m-d H:i:s',$g['mg_time'])); ?></td>                                     
                <td><?php echo ($g['role_name']); ?></td>                                                                        
                <td><a href="<?php echo U('admin/role/distribute',array('role_id'=>$g['role_id']));?>">修改</a></td>
                <td><a href="javascript:;" onclick="if(confirm('确认要删除此商品吗?')){del_goods(<?php echo ($g['goods_id']); ?>)};">删除</a></td>
            </tr><?php endforeach; endif; ?>
            
        </tbody>
    </table>
</div>
 

    </body>
</html>