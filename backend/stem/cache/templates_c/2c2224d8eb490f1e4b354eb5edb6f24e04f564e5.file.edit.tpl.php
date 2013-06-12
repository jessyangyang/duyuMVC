<?php /* Smarty version Smarty-3.1.12, created on 2013-06-06 11:02:33
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150264068351affbc9413853-63687768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c2224d8eb490f1e4b354eb5edb6f24e04f564e5' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/edit.tpl',
      1 => 1370314197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150264068351affbc9413853-63687768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'topButton' => 0,
    'progress' => 0,
    'menuRow' => 0,
    'menuList' => 0,
    'item' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51affbc9d7fed5_87537183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51affbc9d7fed5_87537183')) {function content_51affbc9d7fed5_87537183($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("writer/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body>    
    <header>
            <div class="right-tools">
                <a href="">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            <?php if (is_array($_smarty_tpl->tpl_vars['topButton']->value)){?>
                <div class="right-button">
                	<a href="/writer/title" class="btn fl">上一步：基本信息</a>
                <?php if (isset($_smarty_tpl->tpl_vars['topButton']->value['left'])){?>
                     <a href="<?php if (!isset($_smarty_tpl->tpl_vars['topButton']->value['left']['url'])){?>javascript:void(0)<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['topButton']->value['left']['url'];?>
<?php }?>" class="btn fl btn-next"><?php echo $_smarty_tpl->tpl_vars['topButton']->value['left']['name'];?>
</a>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['topButton']->value['right'])){?>
                    <a href="<?php if (!isset($_smarty_tpl->tpl_vars['topButton']->value['right']['url'])){?>javascript:void(0)<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['topButton']->value['right']['url'];?>
<?php }?>" class="btn btn-danger"><?php echo $_smarty_tpl->tpl_vars['topButton']->value['right']['name'];?>
</a>
                <?php }?>
                </div>
            <?php }?>
            
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point' style="left: <?php echo $_smarty_tpl->tpl_vars['progress']->value;?>
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
        </header>
		
		<div class="container">
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="/writer/edit" method="POST">
					<div class="edit-setting-title">
						<span>更多设置</span>
						<img class="edit-setting-title-img"src="http://<?php echo $_SERVER['SERVER_NAME'];?>
/img/setting-title-arrow.png">
					</div>
					<input type="text" name="menu-title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)" <?php if (isset($_smarty_tpl->tpl_vars['menuRow']->value['title'])){?>value="<?php echo $_smarty_tpl->tpl_vars['menuRow']->value['title'];?>
"<?php }?>/>
					<hr class='title-hr'/>
					<div class="edit-title-subitem">
						<input type="text" name='menu-author' class="span5 edit-title" placeholder="作者" value=""/>
						<hr class='title-hr'/>
						<input type="text" name="menu-summary" class="span5 edit-title" placeholder="摘要" <?php if (isset($_smarty_tpl->tpl_vars['menuRow']->value['summary'])){?>value="<?php echo $_smarty_tpl->tpl_vars['menuRow']->value['summary'];?>
"<?php }?>/>
						<hr class='title-hr'/>
					</div>
					<div class="edit-setting-chapter">
						<table class="table">
							<thead>
                            	<th>ID</th>
	                            <th>标题</th>
	                            <th>排序</th>
	                            <th>操作</th>
                        	</thead>
                        	<tbody>
                        	<?php if ($_smarty_tpl->tpl_vars['menuList']->value){?>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menuList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                            <tr>
                                <td>
                                	<label class="radio inline">
	                				<input type="radio" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" id="optionRadio<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" name="menu-id" <?php if (isset($_smarty_tpl->tpl_vars['menuRow']->value['id'])&&$_smarty_tpl->tpl_vars['menuRow']->value['id']==$_smarty_tpl->tpl_vars['item']->value['id']){?>checked<?php }?>/> <?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>

	                				</label>

	                			</td>
                                <td><a href="/writer/edit/menu/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a></td>
                                <td><input type="text" name='menu-sort' class="span1 edit-title" placeholder="<?php echo $_smarty_tpl->tpl_vars['item']->value['sort'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['sort'];?>
" style="margin:0;padding:0"/></td>
                                <td><a href="/writer/edit/delete/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">删除</a></td>
                            </tr>
                            <?php } ?>
                            <?php }?>
                        	</tbody>
                    </table>
					</div>
                    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
					<textarea id="textarea-content" name="textarea-content" class="ckeditor" placeholder="输入你的内容"><?php if (isset($_smarty_tpl->tpl_vars['menuRow']->value['body'])){?><?php echo $_smarty_tpl->tpl_vars['menuRow']->value['body'];?>
<?php }?>
					</textarea>
					<script>
                        CKEDITOR.replace( 'textarea-content' );
                    </script>
                    <input type="hidden" value="edit" name="state"/>
				</form>
				</div>
			</div>
			<div class="edit-chapter">
				<div class="edit-chapter-top">已录入章节 （1/4）</div>
			</div>
		</div>
<!-- 		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet"> -->
		<!--<script type="text/javascript" src="/js/editor.js"></script>
		<script type="text/javascript" src="/js/editor_ready.js"></script>
        -->

<?php echo $_smarty_tpl->getSubTemplate ("writer/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>