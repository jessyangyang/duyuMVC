<?php /* Smarty version Smarty-3.1.12, created on 2013-06-06 11:04:07
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/end.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214748212051affc27955a04-23574452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba053eee0b04770bffa19888fa6aa904dc9f7b83' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/end.tpl',
      1 => 1370314197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214748212051affc27955a04-23574452',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51affc27a50c22_89153360',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51affc27a50c22_89153360')) {function content_51affc27a50c22_89153360($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("writer/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("writer/progress.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<div class="container">
			<div class="edit-box">
				<h2>给已创建的全本作品添加故事梗概、推荐语、作者简介或其他内容。</h2>
				<div id="edit-box" class="edit-content">
				<form class="form-horizontal" action="/writer/end" method="POST">
					<input type="text" name="title" class="span5 edit-title" placeholder="导言"/>
					<hr class='title-hr'/>
					<textarea id="textarea-content" name="textarea-content" class="edit-textarea"></textarea>
					<input type="hidden" value="end" name="state"/>
				</form>
				
				</div>
			</div>
		</div>
<?php echo $_smarty_tpl->getSubTemplate ("writer/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>