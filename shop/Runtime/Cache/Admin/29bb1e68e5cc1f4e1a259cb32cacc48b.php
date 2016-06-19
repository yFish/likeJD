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

        <div style="font-size: 13px;margin: 10px 5px">
    <form action="" method="post" enctype="multipart/form-data" id="addForm">
       <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td>权限名称:</td>
                <td><input type="text" name="auth_name" /></td>
            </tr> 
             <tr>
                <td>父级权限:</td>
                <td>
                    <select name="auth_pid" id="">
                        <option value="0">-请选择-</option>
                        <?php if(is_array($ainfo)): foreach($ainfo as $key=>$v): ?><option value="<?php echo ($v['auth_id']); ?>">
                                <?php echo str_repeat('---',$v['auth_level']); echo ($v['auth_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>  
             <tr>
                <td>控制器名:</td>
                <td><input type="text" name="auth_c" /></td>
            </tr>  
             <tr>
                <td>操作方法:</td>
                <td><input type="text" name="auth_a" /></td>
            </tr>                
         
        </table>
        <p style="margin-left: 360px"><input type="submit" value="添加">
    </form>
</div>


    </body>
</html>