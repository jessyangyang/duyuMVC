<?php /* Smarty version Smarty-3.1.12, created on 2013-06-12 21:56:10
         compiled from "/home/wwwroot/duyuMVC/backend/stem/application/views/writer/progress.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177657202051b87dfa3fe926-98490427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0ff9a9b01771709dfa2fb09aeb3e625a836c4fb' => 
    array (
      0 => '/home/wwwroot/duyuMVC/backend/stem/application/views/writer/progress.tpl',
      1 => 1370314197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177657202051b87dfa3fe926-98490427',
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
  'unifunc' => 'content_51b87dfa7a7426_91713752',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b87dfa7a7426_91713752')) {function content_51b87dfa7a7426_91713752($_smarty_tpl) {?><body>    
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