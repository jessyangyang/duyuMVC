<?php /* Smarty version Smarty-3.1.12, created on 2013-01-26 00:21:11
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16866948855102b0f755d275-85067882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f8298cc76c10b83b224cf9e28d5fdda42c1ad51' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/edit.tpl',
      1 => 1359119546,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16866948855102b0f755d275-85067882',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5102b0f75964c9_11177789',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5102b0f75964c9_11177789')) {function content_5102b0f75964c9_11177789($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0/">
		<meta name="description" content=""/>
		<meta name="author" content=""/>

		<!-- Base Styles -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet"/>

		<!-- FOR IE6 ~ 8 support of HTML% elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicon and Touch icons -->
		<link rel="shortcut icon" href=""/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href=""/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href=""/>
		<link rel="apple-touch-icon-precomposed" href=""/>
	</head>
	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<div class="right-button">
				<a href="" class="btn fl">录入下一篇</a>
				<a href="" class="btn btn-danger fl">下一步-封面设计</a>
			</div>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point' style="left: 33%"></div>
					<div class="progress">
						<div class="bar bar-danger" style="width: 33%"></div>
					</div>
				</div>
				<ul class="inline">
					<li>基本信息</li>
					<li>文章录入</li>
					<li>封面设计</li>
					<li>撰写导言</li>
				</ul>
			</div>
		</header>
		
		<div class="container">
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="" methods="">
					<input type="text" name="title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)"/>
					<textarea id="textarea1" name="editor1" class="ckeditor">输入您的内容!
					</textarea>
					<script type="text/javascript">
					CKEDITOR.replace('editor1', { height:400, width:800 });
					</script>
				</form>
				</div>
			</div>
			<div class="edit-chapter">
				<div class="edit-chapter-top">已录入章节 （1/4）</div>
			</div>
		</div>
		<footer>
			
		</footer>
		<!-- Javascript
		=============================================== -->

		<!-- Placed at the end of the document so the pages load faster -->

		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script src=""></script>
		<script src=""></script>

	</body>
</html><?php }} ?>