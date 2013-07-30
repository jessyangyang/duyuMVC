<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:12:58
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200164042551f7ba12af29f9-79981116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd49b80b705fc307fd459dc41bbb29eaf3f81d18b' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/index.tpl',
      1 => 1375189970,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200164042551f7ba12af29f9-79981116',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7ba131d7e94_99310231',
  'variables' => 
  array (
    'menus' => 0,
    'key' => 0,
    'menu' => 0,
    'i' => 0,
    'current' => 0,
    'books' => 0,
    'book' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7ba131d7e94_99310231')) {function content_51f7ba131d7e94_99310231($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/wwwroot/duyuMVC/common/third/smarty/plugins/modifier.truncate.php';
?><?php echo $_smarty_tpl->getSubTemplate ("index/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <nav>
        <div id="nav-menus">
        	<?php if ($_smarty_tpl->tpl_vars['menus']->value){?>
        	<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['menu']->key;
?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?><a href="/index/<?php echo $_smarty_tpl->tpl_vars['menu']->value['action'];?>
" class="nav-menu-item <?php if ($_smarty_tpl->tpl_vars['i']->value==count($_smarty_tpl->tpl_vars['menus']->value)){?>nav-item-right<?php }?> <?php if ($_smarty_tpl->tpl_vars['current']->value==$_smarty_tpl->tpl_vars['menu']->value['action']){?>current<?php }?>"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a><?php } ?>
            <?php }?>
        </div>
    </nav>
    </div>
    <article>
        <?php  $_smarty_tpl->tpl_vars['book'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['book']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['books']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['book']->key => $_smarty_tpl->tpl_vars['book']->value){
$_smarty_tpl->tpl_vars['book']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['book']->key;
?>
        <section id="book-item-<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="row book-item-article" data="/book/<?php echo $_smarty_tpl->tpl_vars['book']->value['cover'];?>
">
            <div class="book-section-left">
                <a href="/book/<?php echo $_smarty_tpl->tpl_vars['book']->value['bid'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['book']->value['cover'];?>
"/></a>
            </div>
            <div class="book-section-right">
                 <a href="/book/<?php echo $_smarty_tpl->tpl_vars['book']->value['bid'];?>
"><h3><?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
</h3></a>
                <h5><?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
</h5>
                <span><?php if (isset($_smarty_tpl->tpl_vars['book']->value['price'])&&$_smarty_tpl->tpl_vars['book']->value['price']==0){?>免费<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['book']->value['price'];?>
元<?php }?></span>
                <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['book']->value['summary'],70,"...",true);?>
</p>
            </div>
        </section>
        <?php } ?>
    </article>
<?php echo $_smarty_tpl->getSubTemplate ("index/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>