{include file = "header.tpl"}
	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<div class="right-button">
				<a href="javascript:void(0)" class="btn fl">录入下一篇</a>
				<a href="javascript:void(0)" class="btn btn-danger fl btn-next">下一步-封面设计</a>
			</div>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point' style="left: 33%"></div>
					<div class="progress">
						<div class="bar bar-danger" style="width: 33%"></div>
					</div>
				</div>
				<ul class="inline">
					<li>基本信息</li>
					<li>文章录入</li>
					<li>封面设计</li>
					<li>撰写导言</li>
				</ul>



				</div>
			</div>
		</header>
		
		<div class="container">
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="/writer/edit" method="POST">
					<input type="text" name="title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)"/>
                    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
					<textarea id="textarea1" name="textarea1" class="ckeditor">输入您的内容!
					</textarea>
					<script>
                        CKEDITOR.replace( 'textarea1' );
                    </script>
                    <input type="hidden" value="edit" name="state"/>
				</form>
				</div>
			</div>
			<div class="edit-chapter">
				<div class="edit-chapter-top">已录入章节 （1/4）</div>
			</div>
		</div>
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
		<!--<script type="text/javascript" src="/js/editor.js"></script>
		<script type="text/javascript" src="/js/editor_ready.js"></script>
        -->

{include file = "footer.tpl"}