{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
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
							<div class="btn-group">
							 	<button class="btn">选择模板</button>
								<button class="btn">上传图片</button>
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
{include file = "writer/footer.tpl"}