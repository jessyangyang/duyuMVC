<?php /* Smarty version Smarty-3.1.12, created on 2013-07-30 21:24:46
         compiled from "/home/wwwroot/duyuMVC/m/stem/application/views/index/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122554316051f7bce7f26701-78152648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4846cca896c96bbf184a39e8374dd60e6b824199' => 
    array (
      0 => '/home/wwwroot/duyuMVC/m/stem/application/views/index/user.tpl',
      1 => 1375190682,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122554316051f7bce7f26701-78152648',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51f7bce8141a39_61908409',
  'variables' => 
  array (
    'action' => 0,
    'weibo_url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f7bce8141a39_61908409')) {function content_51f7bce8141a39_61908409($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("index/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
    <?php if ($_smarty_tpl->tpl_vars['action']->value=='login'){?>
    <form action="/user/login" method="POST" class="form-vertical" id="user">
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
            <span class="add-on">邮箱</span><input type="text" name="email" class="span5">
            </div>
            <div class="input-prepend">
            <span class="add-on">密码</span><input type="password" name="password" class="span5">
            </div>
        </div>
    </div>
    <div class="control-group">
        <button class="btn-user" type="submit">登 录</button>
    </div>
    <div class="control-group">
        <p class="weibo-block">
            <a href="<?php echo $_smarty_tpl->tpl_vars['weibo_url']->value;?>
">用微博帐号注册</a>
        </p>
    </div>
    </form>
    <?php }elseif($_smarty_tpl->tpl_vars['action']->value=='register'){?>
    <form action="/user/register" method="POST" class="form-vertical" id="user">
        <div class="control-group">
        <div class="controls">
            <input type="text" name="email" placeholder="填写你的邮箱（用作蠹鱼帐号）" class="span5">
            <input type="password" name="password" placeholder="设一个登录密码（不少于6位）" class="span5">
        </div>
        <div class="controls">
            <button class="btn btn-large" type="submit">登录</button>
        </div>
    </div>
    </form>
    <?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("index/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>