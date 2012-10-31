<?php /* Smarty version Smarty-3.1.12, created on 2012-10-31 17:31:01
         compiled from "/home/wwwroot/duyuMVC/api/stem/application/views/test/addclient.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17703097405090efd52a7e55-92626389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '928871e96f365de4525052278312f4b16e9cdc1a' => 
    array (
      0 => '/home/wwwroot/duyuMVC/api/stem/application/views/test/addclient.tpl',
      1 => 1351675859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17703097405090efd52a7e55-92626389',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5090efd531e542_13365284',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5090efd531e542_13365284')) {function content_5090efd531e542_13365284($_smarty_tpl) {?><!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    </head>
    <body>
        <h1>addClient</h1>
        <form action="/api/test/addClient" method="POST">
            <label for="title">title :</label>
            <input type="text" name="title"/><br/>
            <label for="summary">summary : </label>
            <input type="password" name="summary"/><br/>
            <label for="redirect_url">redirect_url :</label>
            <input type="password" name="redirect_url"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="login"/>
        </form>
    </body>
</html><?php }} ?>