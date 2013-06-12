<?php /* Smarty version Smarty-3.1.12, created on 2013-06-04 10:58:42
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/progress.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176841478151ad57e2504618-39612411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ed4655791ff816e7d4d7fc73eb6f5782f19885b' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/progress.tpl',
      1 => 1370314197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176841478151ad57e2504618-39612411',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'topButton' => 0,
    'progress' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51ad57e27880a7_99165332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51ad57e27880a7_99165332')) {function content_51ad57e27880a7_99165332($_smarty_tpl) {?><body>    
    <header>
            <div class="right-tools">
                <a href="/writer/index">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            <?php if (is_array($_smarty_tpl->tpl_vars['topButton']->value)){?>
                <div class="right-button">
                <?php if (isset($_smarty_tpl->tpl_vars['topButton']->value['left'])){?>
                     <a href="<?php if (!isset($_smarty_tpl->tpl_vars['topButton']->value['left']['url'])){?>javascript:void(0)<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['topButton']->value['left']['url'];?>
<?php }?>" class="btn fl btn-previous"><?php echo $_smarty_tpl->tpl_vars['topButton']->value['left']['name'];?>
</a>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['topButton']->value['right'])){?>
                    <a href="<?php if (!isset($_smarty_tpl->tpl_vars['topButton']->value['right']['url'])){?>javascript:void(0)<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['topButton']->value['right']['url'];?>
<?php }?>" class="btn btn-danger btn-next"><?php echo $_smarty_tpl->tpl_vars['topButton']->value['right']['name'];?>
</a>
                <?php }?>
                </div>
            <?php }?>
            
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point' style="left: <?php echo $_smarty_tpl->tpl_vars['progress']->value-4;?>
%"></div>
                    <div class="progress">
                        <div class="bar" style="width:<?php echo $_smarty_tpl->tpl_vars['progress']->value;?>
%"></div>
                    </div>
                </div>
                <ul class="inline">
                    <li>基本信息</li>
                    <li>文章录入</li>
                    <li>封面设计</li>
                    <li>撰写导言</li>
                </ul>
            </div>
        </header><?php }} ?>