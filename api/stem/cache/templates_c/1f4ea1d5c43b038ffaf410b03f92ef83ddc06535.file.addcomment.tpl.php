<?php /* Smarty version Smarty-3.1.12, created on 2013-01-24 09:41:37
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/addcomment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55046713150fe97a8a3c711-84572920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f4ea1d5c43b038ffaf410b03f92ef83ddc06535' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/addcomment.tpl',
      1 => 1358990822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55046713150fe97a8a3c711-84572920',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50fe97a8acc705_00736095',
  'variables' => 
  array (
    'title' => 0,
    'user' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50fe97a8acc705_00736095')) {function content_50fe97a8acc705_00736095($_smarty_tpl) {?><!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <h1>AddComment</h1>
        <form action="/api/test/addComment" method="POST">
            <label for="id">id :</label>
            <input type="text" name="uid" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"/><br/>
            <label for="email">email :</label>
            <input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
"/><br/>
            <label for="post_id">bookid :</label>
            <input type="text" name="post_id"/><br/>
            <label for="type">type :</label>
            <input type="text" name="type" value="1"/><br/>
            <label for="content">content : </label>
            <input type="text" name="content"/><br/>
            <label for="parent">parent :</label>
            <input type="text" name="parent" value='0'/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="comment"/>
        </form>
        <h3><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</h3>
    </body>
</html><?php }} ?>