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
						<input type="text" class="span5" name="title" {if isset($info.title)}value="{$info.title}"{/if}/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作者名称：</label>
					<div class="controls">
					<input type="text" class="span5" name="author"  {if isset($info.author)}value="{$info.author}"{/if}/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作品体裁：</label>
					<div class="controls">
					{if isset($category)}
						{foreach $category as $key=>$item}
	              		<label class="radio inline">
	                	<input type="radio" value="{$item.cid}" id="optionRadio{$key}" name="category" {if isset($info.cid) && $info.cid eq $item.cid}checker{/if}/> {$item.name}</label>
	                	{/foreach}
	                {/if}
	            	</div>
	            	</div>
	            	<div class="control-group">
	            	<label class="control-label" for="">作品标签：</label>
	            	<div class="controls">
					<input type="text" class="span5" name="tags" placeholder="多个标签用空格隔开，如'建筑 哥特式风格 罗马'" {if isset($info.tags)}value="{$info.tags}"{/if}/>
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