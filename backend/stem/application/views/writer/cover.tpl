{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
		<div class="container">
			<div class="edit-box">
				<h2>给已上传的作品添加封面。</h2>
				<div id="edit-box" class="edit-cover">
				<form class="form-horizontal" action="/writer/cover" method="POST" enctype="multipart/form-data">
					<fieldset>
					<div class="span5">
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
							<p>你可以给自己的作品在下列封面中选择自己喜欢的封面，也可以上传图片为自己的作品添加封面。</p>
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
							<div class="inline">
							 	<input type="file" name="thumb" data="/writer/cover/thumb" class="edit-action-button"/>上传商店封面
								<input type="file" name="cover" data="/writer/cover/cover" class="edit-action-button"/>上传epub封面
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
					</div>
					<div class="span3">
					<div class="edit-cover-show">
						{if $cover}<img src="{$cover}"/>{/if}
					</div>
					</div>
					</fieldset>
					<input type="hidden" value="cover" name="state"/>
				</form>
			</div>
		</div>
{include file = "writer/footer.tpl"}