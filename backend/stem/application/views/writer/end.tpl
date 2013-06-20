{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
		<div class="container">
			<div class="edit-box">
				<h2>给已创建的全本作品添加故事梗概、推荐语、作者简介或其他内容。</h2>
				<div id="edit-box" class="edit-content">
				<form class="form-horizontal" action="/writer/end" method="POST">
					<input type="text" name="title" class="span5 edit-title" placeholder="导言"/>
					<hr class='title-hr'/>
					<textarea id="textarea-content" name="summary" class="edit-textarea">{if $summary}{$summary}{/if}</textarea>
					<input type="hidden" value="end" name="state"/>
				</form>
				
				</div>
			</div>
		</div>
{include file = "writer/footer.tpl"}