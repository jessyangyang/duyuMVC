<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:47:35
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203521096951f7ba56197723-01054669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b3982f4a49436f7c87d24b45edda706795bd00a' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/header.tpl',
      1 => 1375191704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203521096951f7ba56197723-01054669',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7ba562079e5_21469868',
  'variables' => 
  array (
    'title' => 0,
    'topTitle' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7ba562079e5_21469868')) {function content_51f7ba562079e5_21469868($_smarty_tpl) {?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="description" content=""/>
        <meta name="author" content=""/>

        <!-- Base Styles -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/css/m.css" rel="stylesheet">

        <!-- FOR IE6 ~ 8 support of HTML% elements -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="/js/html5.js"></script>
        <![endif]-->

        <!-- Favicon and Touch icons -->
        <!-- <link rel="shortcut icon" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" href=""/> -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.hotkeys.js"></script>
        <script type="text/javascript" src="/js/jquery.retina.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </head>
<body>
    <div id="header">
    <header>
        <a href="/index"><div class="header-back">上一页</div></a>
        <h1><?php echo $_smarty_tpl->tpl_vars['topTitle']->value;?>
</h1>
        <a href="/user/login"><div class="header-user">账户</div></a>
    </header><?php }} ?>