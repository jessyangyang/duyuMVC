{include file = "ats/header.tpl"}
	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<a href="javascript:void(0)" class="btn btn-danger right-button btn-next">下一步：撰写导言</a>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point'></div>
					<div class="progress">
						<div class="bar" style="width: 0%"></div>
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
			<div class="edit-box">
				<h2>录入的信息包括全本作品的名称、作者、体裁以及作品标签。</h2>
				<div id="edit-box" class="edit-info">
					<form class="form-horizontal" action="/ats/title" method="POST">
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
	              		<label class="checkbox inline">
	                	<input type="checkbox" value="option1" id="inlineCheckbox1"> 小说</label>
	              		<label class="checkbox inline">
						<input type="checkbox" value="option2" id="inlineCheckbox2"> 随笔</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option3" id="inlineCheckbox3"> 诗歌</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option4" id="inlineCheckbox4"> 剧本</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option5" id="inlineCheckbox5"> 文论</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option6" id="inlineCheckbox6"> 非文学</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option7" id="inlineCheckbox7"> 其他</label>
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
{include file = "ats/footer.tpl"}