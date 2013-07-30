<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:33:38
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/purchased.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123616182451f7c0605896a7-88805797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e4708b01144773577444f3dc62feae4d899d5e1' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/purchased.tpl',
      1 => 1375191213,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123616182451f7c0605896a7-88805797',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7c060773478_38973602',
  'variables' => 
  array (
    'purchased' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7c060773478_38973602')) {function content_51f7c060773478_38973602($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("index/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="m-purchased-info row">付费书籍2部，免费书籍1部，共花费12.00元</div>
<ul class="unstyled m-purchased-ul row">
<?php if ($_smarty_tpl->tpl_vars['purchased']->value){?>
	<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['purchased']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
	<li>
        <div class="m-purchased-left fl"><h4><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</h4></div>
        <div class="m-purchased-right text-r fl"><span><?php echo $_smarty_tpl->tpl_vars['val']->value['price'];?>
</span><p><?php echo $_smarty_tpl->tpl_vars['val']->value['published'];?>
</p></div>
    </li>
	<?php } ?>
<?php }?>
</ul>
<?php echo $_smarty_tpl->getSubTemplate ("index/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>