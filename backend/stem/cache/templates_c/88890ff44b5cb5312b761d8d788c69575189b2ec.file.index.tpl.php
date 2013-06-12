<?php /* Smarty version Smarty-3.1.12, created on 2013-01-26 02:51:52
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2492740815102938a7dbe16-94310255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88890ff44b5cb5312b761d8d788c69575189b2ec' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/ats/index.tpl',
      1 => 1359137346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2492740815102938a7dbe16-94310255',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5102938a87bcb3_44054935',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5102938a87bcb3_44054935')) {function content_5102938a87bcb3_44054935($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("ats/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <body>
        <header>
            <div class="right-tools">
                <a href="">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            <a href="" class="btn btn-danger right-button">下一步：撰写导言</a>
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point'></div>
                    <div class="progress">
                        <div class="bar" style="width: 0%"></div>
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
            <div class="edit-box">
                <div id="edit-box" class="edit-info">
                <form action="/ats/title" method="POST" class="form-horizontal" >
                    <fieldset>
                    <div class="control-group">
                    <label class="control-label" for="">请先登录</label>
                    <div class="controls">
                        <input type="text" class="input-small" name="email" placeholder="邮件">
                        <input type="password" class="input-small" name="password" placeholder="密码">
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                    <label class="checkbox">
                    <input type="checkbox"> 记住我
                    </label>
                    <input type="hidden" value="title" name="state"/>
                    <button type="submit" class="btn btn-commit">登录</button>
                    </div>
                    </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
<?php echo $_smarty_tpl->getSubTemplate ("ats/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>