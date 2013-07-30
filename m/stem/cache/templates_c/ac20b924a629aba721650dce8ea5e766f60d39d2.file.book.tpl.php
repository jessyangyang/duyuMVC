<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:13:58
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/book.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38712147551f7bbe1881bc9-50749497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac20b924a629aba721650dce8ea5e766f60d39d2' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/book.tpl',
      1 => 1375190007,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38712147551f7bbe1881bc9-50749497',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7bbe1eed364_66326764',
  'variables' => 
  array (
    'book' => 0,
    'purchased' => 0,
    'menus' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7bbe1eed364_66326764')) {function content_51f7bbe1eed364_66326764($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("index/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
    <article>
        <?php if (isset($_smarty_tpl->tpl_vars['book']->value)){?>
        <div id="article-cover">
            <div class="article-cover-left">
                <img src="<?php echo $_smarty_tpl->tpl_vars['book']->value['cover'];?>
"/>
            </div>
            <div class="article-cover-center">
                <h2><?php echo $_smarty_tpl->tpl_vars['book']->value['title'];?>
</h2>
                <p><span>作者</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
</p>
                <p><span>体裁</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['name'];?>
</p>
                <p><span>版权</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['copyright'];?>
</p>
                <div class="article-cover-right">
                <?php if (isset($_smarty_tpl->tpl_vars['purchased']->value)&&in_array($_smarty_tpl->tpl_vars['book']->value['bid'],$_smarty_tpl->tpl_vars['purchased']->value)||$_smarty_tpl->tpl_vars['book']->value['price']==0){?><a href="http://api.duyu.cc/api/store/download/book/<?php echo $_smarty_tpl->tpl_vars['book']->value['bid'];?>
" class='btn-pay'>阅读</a><?php }else{ ?><p class="price"><?php echo $_smarty_tpl->tpl_vars['book']->value['price'];?>
 元</p><a href="/payment/<?php echo $_smarty_tpl->tpl_vars['book']->value['bid'];?>
" class='btn-pay'>购买全本</a><?php }?>
             </div>
             </div>
        </div>
        <div id="article-summary">
            <h3>导言</h3>
            <p><?php echo $_smarty_tpl->tpl_vars['book']->value['summary'];?>
</p>
            <a href=""></a>
        </div>
        <div id="article-menu">
            <h3>目录</h3>
            <?php if (isset($_smarty_tpl->tpl_vars['menus']->value)){?>
            <ul class="unstyled">
                <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['menu']->key;
?>
                <li><?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
</li>
                <?php } ?>
            </ul>
            <?php }?>
            <a href=""></a>
        </div>
        <div id="article-info">
            <h3>信息</h3>
            <ul class="unstyled">
                <li><span>体裁</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['name'];?>
</li>
                <li><span>版权</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['copyright'];?>
</li>
                <li><span>标签</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['tags'];?>
</li>
                <li><span>设计</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['designer'];?>
</li>
                <li><span>校对</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['proofreader'];?>
</li>
                <li><span>字数</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['wordcount'];?>
</li>
                <li><span>上架</span> <?php echo $_smarty_tpl->tpl_vars['book']->value['dateline'];?>
</li>
            </ul>
            <a href=""></a>
        </div>
        <?php }?>
    </article>
<?php echo $_smarty_tpl->getSubTemplate ("index/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>