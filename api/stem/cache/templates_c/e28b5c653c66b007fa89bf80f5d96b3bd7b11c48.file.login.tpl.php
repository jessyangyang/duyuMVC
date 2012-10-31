<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 16:46:20
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14137789025090e3d44d3f98-77775485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e28b5c653c66b007fa89bf80f5d96b3bd7b11c48' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/login.tpl',
      1 => 1351673099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14137789025090e3d44d3f98-77775485',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5090e3d455a922_36375915',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5090e3d455a922_36375915')) {function content_5090e3d455a922_36375915($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <h1>login</h1>
        <form action="/api/test/login" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="login"/>
        </form>
    </body>
</html><?php }} ?>