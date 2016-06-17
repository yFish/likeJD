<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta content="MSHTML 6.00.6000.16674" name="GENERATOR" />

        <title>用户登录</title>

        <link href="/Public/Admin/css/User_Login.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" charset="utf-8" src="<?php echo (C("COMMON_URL")); ?>js/jquery-2.1.4.min.js"></script>
    </head><body id="userlogin_body">
        <div></div>
        <div id="user_login">
            <dl>
                <dd id="user_top">
                    <ul>
                        <li class="user_top_l"></li>
                        <li class="user_top_c"></li>
                        <li class="user_top_r"></li></ul>
                </dd><dd id="user_main">
                    <form action="/index.php/admin/admin/login" method="post" id='loginForm'>
                        <ul>
                            <li class="user_main_l"></li>
                            <li class="user_main_c">
                                <div class="user_main_box">
                                    <ul>
                                        <li class="user_main_text">用户名： </li>
                                        <li class="user_main_input">
                                            <input class="TxtUserNameCssClass" id="admin_user" maxlength="20" name="admin_user"> </li></ul>
                                    <ul>
                                        <li class="user_main_text">密&nbsp;&nbsp;&nbsp;&nbsp;码： </li>
                                        <li class="user_main_input">
                                            <input class="TxtPasswordCssClass" id="admin_psd" name="admin_psd" type="password">
                                        </li>
                                    </ul>
                                    
                                    <ul>
                                        <li class="user_main_text">验证码： </li>
                                        <li class="user_main_input">
                                            <input class="TxtValidateCodeCssClass" onkeyup='check_code();'maxlength='4' id="captcha" name="captcha" type="text">
                                             <img id='verify'src="<?php echo U('verifyImg');?>"  alt="" title='点击换一张' onclick='this.src=this.src'/>
                                        </li>                                       
                                    </ul>
                                     <ul>
                                        
                                        <li class="user_main_input " id='spd'>
                                           
                                        </li>
                                    </ul>
                                    <script>
                                                var flag = false;
                                                function check_code(){

                                                    //获取用户输入的验证码
                                                    var cod = $('#captcha').val();
                                                    var login = $('#loginForm');
                                                    
                                                    if(cod.length == 4)
                                                    {
                                                        //通过ajax调用后台服务器验证验证码是否正确
                                                        $.ajax({
                                                            url:"<?php echo U('checkCode');?>",
                                                            data:{'code':cod},
                                                            type:'get',
                                                            dataType:'json',
                                                            success:function(msg){
                                                                if(msg.res==1)
                                                                {                                       
                                                                    //alert('验证码正确');
                                                                     $('#spd').html("<span style='color: green;font:12px' >验证码正确</span>");
                                                                     flag = true;
                                                                }
                                                                else 
                                                                {
                                                                    //弹出提示信息
                                                                    $('#spd').html("<span style='color: red;font:12px' >验证码有误!</span>");

                                                                    //调用点击事件刷新验证码
                                                                    $('#verify').click();  

                                                                    flag = false;                                                                                                                                   
                                                                }

                                                            }

                                                        });
                                                    }

                                               }

                                          
                                        </script>    

                                </div>
                            </li>
                            <li class="user_main_r">

                                <input style="border: medium none; background: url('/Public/Admin/img/user_botton.gif') repeat-x scroll left top transparent; height: 122px; width: 111px; display: block; cursor: pointer;" value="" type="submit">
                            </li>
                        </ul>
                    </form>
                    <script>
                        $(function(){
                            $('form').submit(function(evt){
                        
                                    if(flag===false)
                                    {    
                                        alert('请确认验证码!');
                                        evt.preventDefault();
                                    }
                            })
                              
                        });
                    </script>
                </dd><dd id="user_bottom">
                    <ul>
                        <li class="user_bottom_l"></li>
                        <li class="user_bottom_c"><span style="margin-top: 40px;"></span> </li>
                        <li class="user_bottom_r"></li></ul></dd></dl></div><span id="ValrUserName" style="display: none; color: red;"></span><span id="ValrPassword" style="display: none; color: red;"></span><span id="ValrValidateCode" style="display: none; color: red;"></span>
        <div id="ValidationSummary1" style="display: none; color: red;"></div>
    </body>
</html>