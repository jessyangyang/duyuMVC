<?php /* Smarty version Smarty-3.1.12, created on 2012-11-17 18:28:16
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/reg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70129231450a7622044fd23-11444107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76f8216fdde324037cbf84e69b135185e6dd3ae8' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/reg.tpl',
      1 => 1353148075,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70129231450a7622044fd23-11444107',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a762204d9fa1_65035315',
  'variables' => 
  array (
    'title' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a762204d9fa1_65035315')) {function content_50a762204d9fa1_65035315($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <form action="/api/test/reg" method="POST" enctype="multipart/form-data">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="username">username</label>
            <input type="text" name="username"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <label for="avatar">avatar</label>
            <input type="file" name="avatar"/></br>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="reg"/>
        </form>
        <h2><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h2>
    </body>
</html><?php }} ?>