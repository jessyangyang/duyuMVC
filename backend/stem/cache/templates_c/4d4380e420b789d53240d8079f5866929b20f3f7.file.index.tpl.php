<?php /* Smarty version Smarty-3.1.12, created on 2013-06-12 21:56:09
         compiled from "/home/wwwroot/duyuMVC/backend/stem/application/views/writer/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138009100751b87df9e4f8c1-36273768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d4380e420b789d53240d8079f5866929b20f3f7' => 
    array (
      0 => '/home/wwwroot/duyuMVC/backend/stem/application/views/writer/index.tpl',
      1 => 1371044379,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138009100751b87df9e4f8c1-36273768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'islogin' => 0,
    'list' => 0,
    'key' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51b87dfa3944e9_13923146',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51b87dfa3944e9_13923146')) {function content_51b87dfa3944e9_13923146($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/wwwroot/duyuMVC/common/third/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("writer/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("writer/progress.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
        <div class="container">
            <div class="edit-box">
                <div id="edit-box" class="edit-info">
                <form action="/writer/index" method="POST" class="form-horizontal" >
                    <fieldset>
                    <?php if ($_smarty_tpl->tpl_vars['islogin']->value==0){?>
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
                    <input type="hidden" value="index" name="state"/>
                    <button type="submit" class="btn btn-commit">登录</button>
                    </div>
                    </div>
                    <?php }else{ ?>
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>分类</th>
                            <th>创建时间</th>
                            <th>发布状态</th>
                        </thead>
                        <tbody>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                                <td><a href="/writer/title/<?php echo $_smarty_tpl->tpl_vars['item']->value['bid'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['author'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['published'],"%H:%M %D");?>
</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn dropdown-toggle"><?php if ($_smarty_tpl->tpl_vars['item']->value['status']==1){?>未发布<?php }else{ ?>已发布<?php }?> <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/writer/index/state/<?php echo $_smarty_tpl->tpl_vars['item']->value['bid'];?>
/1">未发布</a></li>
                                            <li><a href="/writer/index/state/<?php echo $_smarty_tpl->tpl_vars['item']->value['bid'];?>
/3">已发布</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)" id="edit-delete-button">删除</a></li>
                                                <div class="modal" id="edit-delete-modal">
                                                    <div class="modal-header">
                                                    <a class="close" data-dismiss="modal">×</a>
                                                    <h3>删除图书"<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
"吗</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <a href="javascript:void(0)" class="btn">取消</a>
                                                    <a href="/writer/title/delete/<?php echo $_smarty_tpl->tpl_vars['item']->value['bid'];?>
" class="btn btn-primary">确定</a>
                                                    </div>
                                                </div>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <input type="hidden" value="title" name="state"/>
                    <?php }?>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
<script type="text/javascript" src="/js/bootstrap/bootstrap.modal.js"></script>
<?php echo $_smarty_tpl->getSubTemplate ("writer/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>