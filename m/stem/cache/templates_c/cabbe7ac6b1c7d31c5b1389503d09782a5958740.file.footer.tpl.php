<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:18:34
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171266245251f7ba5621dbf7-84788310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cabbe7ac6b1c7d31c5b1389503d09782a5958740' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/footer.tpl',
      1 => 1375190282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171266245251f7ba5621dbf7-84788310',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7ba5630be00_47150095',
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7ba5630be00_47150095')) {function content_51f7ba5630be00_47150095($_smarty_tpl) {?>        <footer>
        	<ul class="unstyled inline info">
        		<?php if (isset($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['user']->value){?>
        		<li class="user"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</li>
        		<li><a href="/user/logout">退出</a></li>
                <li>|</li>
                <?php }else{ ?>
                <li><a href="/user">登录</a></li>
                <li>|</li>
        		<?php }?>
        		<li class="user">手机版</li>
        		<div id="footer">©2013 Duyupress.com</div>
        	</ul>
        </footer>
        <!-- Javascript
        =============================================== -->

        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="/js/jquery.form.js"></script>
        <script type="text/javascript" src="/js/jquery.ajax.js"></script>
        <script type="text/javascript" src="/js/m.js"></script>

    </body>
</html><?php }} ?>