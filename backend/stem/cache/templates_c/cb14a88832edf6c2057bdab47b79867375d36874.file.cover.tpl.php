<?php /* Smarty version Smarty-3.1.12, created on 2013-06-06 11:54:11
         compiled from "/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/cover.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38969665151affc0f1bb075-23662094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb14a88832edf6c2057bdab47b79867375d36874' => 
    array (
      0 => '/home/wwwroot/duyuMVC/ATSystem/stem/application/views/writer/cover.tpl',
      1 => 1370490807,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38969665151affc0f1bb075-23662094',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51affc0f949e26_95301447',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51affc0f949e26_95301447')) {function content_51affc0f949e26_95301447($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("writer/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("writer/progress.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="container">
			<div class="edit-box">
				<h2>给已上传的作品添加封面。</h2>
				<div id="edit-box" class="edit-cover">
				<form class="form-horizontal" action="/writer/cover" method="POST">
					<fieldset>
					<div class="control-group-left">
					<div class="control-group">
						<label class="edit-label" for=""><span>1</span></label>
						<div class="controls">
							<h4>封面信息</h4>
							<p>给标题加换行就可以改变它们在封面上的样子。</p>
							<textarea class="edit-cover-info"></textarea>

						</div>
					</div>
					<div class="control-group">
						<div class="controls">
		              		<label class="radio inline">
		                	<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> 白色文字</label>
		              		<label class="radio inline">
							<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> 黑色文字</label>
		            	</div>
					</div>
					<div class="control-group">
						<label class="edit-label" for=""><span>2</span></label>
						<div class="controls">
							<h4>封面模板</h4>
							<p>你可以给自己的作品在下列封面中选择自己喜欢的封面，也可以上传图片为自己<br/>的作品添加封面。</p>
							<div class="modal hide fade" id="UploadCoverModel" style="display: none;">
					            <div class="modal-header">
					              <a data-dismiss="modal" class="close">×</a>
					              <h3>对话框标题</h3>
					            </div>
					            <div class="modal-body">
					              <h4>对话框文字</h4>
					            </div>
					            <div class="modal-footer">
					              <a data-dismiss="modal" class="btn" href="#">关闭</a>
					              <a class="btn btn-primary" href="#">保存更改</a>
					            </div>
					        </div>
							<div class="btn-group">
							 	<button class="btn">选择模板</button>
								<button id="UploadCover" class="btn">上传图片</button>
							</div>
						</div>
						<div class="controls">
							<!-- <a href="" class="edit-cover-list"><img src="" class="img-rounded"/></a> -->
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list edit-cover-end"></a>
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list"></a>
							<a class="edit-cover-list edit-cover-end"></a>
						</div>
					</div>
					
					<div class="control-group-right">
						
					</div>
					</fieldset>
					<input type="hidden" value="cover" name="state"/>
				</form>
				</div>
			</div>
		</div>
<?php echo $_smarty_tpl->getSubTemplate ("writer/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>