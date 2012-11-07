<?php /* Smarty version Smarty-3.1.12, created on 2012-11-07 15:17:43
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1022588804509a0b17e5e803-75158480%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e28b5c653c66b007fa89bf80f5d96b3bd7b11c48' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/login.tpl',
      1 => 1352190973,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1022588804509a0b17e5e803-75158480',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509a0b18190352_99257972',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509a0b18190352_99257972')) {function content_509a0b18190352_99257972($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <h1>login</h1>
        <?php if ($_smarty_tpl->tpl_vars['user']->value){?>
        <h2>id:[<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
] <span><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</span></h2>
        <?php }else{ ?>
        <form action="/api/test/login" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="login"/>
        </form>
        <?php }?>
    </body>
</html><?php }} ?>