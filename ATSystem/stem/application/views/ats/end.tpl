{include file = "ats/header.tpl"}
	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<div class="right-button">
				<a href="javascript:void(0)" class="btn btn-danger fl">完成并提交全本</a>
			</div>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point' style="left: 94%"></div>
					<div class="progress">
						<div class="bar bar-danger" style="width: 100%"></div>
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
				<h2>给已创建的全本作品添加故事梗概、推荐语、作者简介或其他内容。</h2>
				<div id="edit-box" class="edit-content">
				<form class="form-horizontal" action="/ats/end" method="POST">
					<input type="text" name="title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)"/>
					<textarea id="textarea1" name="editor1" class="edit-textarea">
					</textarea>
					<input type="hidden" value="complete" name="state"/>
				</form>
				
				</div>
			</div>
		</div>
{include file = "ats/footer.tpl"}