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

        <style>
    .yang{
        width: 200px;
        float: left;
    }
</style>
<div style="font-size: 13px;margin: 10px 5px">
    <form action="/index.php/admin/role/distribute/role_id/51.html" method="post" enctype="multipart/form-data" id="addForm">

       <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td colspan='100' style='font-size: 20px;' >
                    当前分配的角色名称:<?php echo ($roleinfo['role_name']); ?></td>   
            </tr>  
            <?php if(is_array($auth_infoA)): foreach($auth_infoA as $key=>$v): ?><tr>
                <td><input type="checkbox" name='role_auth_ids[]'value="<?php echo ($v['auth_id']); ?>"

                 <?php if(in_array(($v['auth_id']), is_array($roleinfo['role_auth_ids'])?$roleinfo['role_auth_ids']:explode(',',$roleinfo['role_auth_ids']))): ?>checked<?php endif; ?>
                 ><?php echo ($v['auth_name']); ?></td>
            <td>
                <?php if(is_array($auth_infoB)): foreach($auth_infoB as $key=>$vv): if($vv['auth_pid'] == $v['auth_id']): ?><div class='yang'><input type="checkbox" name='role_auth_ids[]' value="<?php echo ($vv['auth_id']); ?>"
                                <?php if(in_array(($vv['auth_id']), is_array($roleinfo['role_auth_ids'])?$roleinfo['role_auth_ids']:explode(',',$roleinfo['role_auth_ids']))): ?>checked<?php endif; ?>
                        ><?php echo ($vv['auth_name']); ?></div><?php endif; endforeach; endif; ?>
            </td>
            </tr><?php endforeach; endif; ?>
            <tr>
                <input type="hidden" value="<?php echo ($roleinfo['role_id']); ?>" name="role_id">
                <td colspan='100' ><input type="submit" name='now_act' value='提交分配'></td>
            </tr>
        </table>  
    </form>
</div>


    </body>
</html>