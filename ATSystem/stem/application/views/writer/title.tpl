{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}		
		<div class="container">
			<div class="edit-box">
				<h2>录入的信息包括全本作品的名称、作者、体裁以及作品标签。</h2>
				<div id="edit-box" class="edit-info">
					<form class="form-horizontal" action="/writer/title" method="POST">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="">作品名称：</label>
					<div class="controls">
						<input type="text" class="span5" name="title" {if $info}value="{$info.title}"{/if}/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作者名称：</label>
					<div class="controls">
					<input type="text" class="span5" name="author"  {if $info}value="{$info.author}"{/if}/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作品体裁：</label>
					<div class="controls">
						{foreach $category as $key=>$item}
	              		<label class="radio inline">
	                	<input type="radio" value="{$item.cid}" id="optionRadio{$key}" name="category"> {$item.name}</label>
	                	{/foreach}
	            	</div>
	            	</div>
	            	<div class="control-group">
	            	<label class="control-label" for="">作品标签：</label>
	            	<div class="controls">
					<input type="text" class="span5" name="tag" placeholder="多个标签用逗号隔开，如建筑，哥特式风格，罗马"/>
					<input type="hidden" value="title" name="state"/>
					</div>
					</div>
					</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
{include file = "writer/footer.tpl"}