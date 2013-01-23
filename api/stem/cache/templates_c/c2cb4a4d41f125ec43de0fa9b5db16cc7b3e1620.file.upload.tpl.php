<?php /* Smarty version Smarty-3.1.12, created on 2013-01-15 11:02:21
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:196517598450f4c6bd3cb072-20674016%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2cb4a4d41f125ec43de0fa9b5db16cc7b3e1620' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/upload.tpl',
      1 => 1352268095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196517598450f4c6bd3cb072-20674016',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50f4c6bd551ec3_19888724',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f4c6bd551ec3_19888724')) {function content_50f4c6bd551ec3_19888724($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <h1>upload</h1>
        <form action="/api/test/upload" method="POST" enctype="multipart/form-data">
            <label for="file">image</label><br/>
            <input type="file" name="file" id="file"/><br/>
            <input type="text" name="type" id="type"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="upload"/>
        </form>
    </body>
</html><?php }} ?>