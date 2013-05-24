{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
		
		<div class="container">
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="/writer/edit" method="POST">
					<div class="edit-setting-title">
						<span>更多设置</span>
						<img class="edit-setting-title-img"src="http://{$smarty.server.SERVER_NAME}/img/setting-title-arrow.png">
					</div>
					<input type="text" name="title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)"/>
					<hr class='title-hr'/>
					<div class="edit-title-subitem">
						<input type="text" name='author' class="span5 edit-title" placeholder="作者" value=""/>
						<hr class='title-hr'/>
						<input type="text" name="summary" class="span5 edit-title" placeholder="摘要" value=""/>
						<hr class='title-hr'/>
					</div>
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
<!-- 		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet"> -->
		<!--<script type="text/javascript" src="/js/editor.js"></script>
		<script type="text/javascript" src="/js/editor_ready.js"></script>
        -->

{include file = "writer/footer.tpl"}