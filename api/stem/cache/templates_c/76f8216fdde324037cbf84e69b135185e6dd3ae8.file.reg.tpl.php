<?php /* Smarty version Smarty-3.1.12, created on 2012-10-28 22:37:55
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/reg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2062182216508d3d1c7877f3-23663393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76f8216fdde324037cbf84e69b135185e6dd3ae8' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/reg.tpl',
      1 => 1351435072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2062182216508d3d1c7877f3-23663393',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_508d3d1c7bf7f3_74609011',
  'variables' => 
  array (
    'title' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_508d3d1c7bf7f3_74609011')) {function content_508d3d1c7bf7f3_74609011($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <form action="/api/test/reg" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="username">username</label>
            <input type="text" name="username"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="commit"/>
        </form>
        <h2><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h2>
    </body>
</html><?php }} ?>