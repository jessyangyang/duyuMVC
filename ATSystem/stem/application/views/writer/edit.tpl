{include file = "writer/header.tpl"}
<body>    
    <header>
            <div class="right-tools">
                <a href="">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            {if is_array($topButton)}
                <div class="right-button">
                	<a href="/writer/title" class="btn fl">上一步：基本信息</a>
                {if isset($topButton.left)}
                     <a href="{if !isset($topButton.left.url)}javascript:void(0){else}{$topButton.left.url}{/if}" class="btn fl btn-next">{$topButton.left.name}</a>
                {/if}
                {if isset($topButton.right)}
                    <a href="{if !isset($topButton.right.url)}javascript:void(0){else}{$topButton.right.url}{/if}" class="btn btn-danger">{$topButton.right.name}</a>
                {/if}
                </div>
            {/if}
            
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point' style="left: {$progress}%"></div>
                    <div class="progress">
                        <div class="bar" style="width:{$progress}%"></div>
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
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="/writer/edit" method="POST">
					<div class="edit-setting-title">
						<span>更多设置</span>
						<img class="edit-setting-title-img"src="http://{$smarty.server.SERVER_NAME}/img/setting-title-arrow.png">
					</div>
					<input type="text" name="menu-title" class="span5 edit-title" placeholder="新建章节 (不分章节的作品可不填)" {if isset($menuRow.title)}value="{$menuRow.title}"{/if}/>
					<hr class='title-hr'/>
					<div class="edit-title-subitem">
						<input type="text" name='menu-author' class="span5 edit-title" placeholder="作者" value=""/>
						<hr class='title-hr'/>
						<input type="text" name="menu-summary" class="span5 edit-title" placeholder="摘要" {if isset($menuRow.summary)}value="{$menuRow.summary}"{/if}/>
						<hr class='title-hr'/>
					</div>
					<div class="edit-setting-chapter">
						<table class="table">
							<thead>
                            	<th>ID</th>
	                            <th>标题</th>
	                            <th>排序</th>
	                            <th>操作</th>
                        	</thead>
                        	<tbody>
                        	{if $menuList}
                            {foreach $menuList as $key => $item}
                            <tr>
                                <td>
                                	<label class="radio inline">
	                				<input type="radio" value="{$item.id}" id="optionRadio{$key}" name="menu-id" {if isset($menuRow.id) && $menuRow.id eq $item.id}checked{/if}/> {$key+1}
	                				</label>

	                			</td>
                                <td><a href="/writer/edit/menu/{$item.id}">{$item.title}</a></td>
                                <td><input type="text" name='menu-sort' class="span1 edit-title" placeholder="{$item.sort}" value="{$item.sort}" style="margin:0;padding:0"/></td>
                                <td><a href="/writer/edit/delete/{$item.id}">删除</a></td>
                            </tr>
                            {/foreach}
                            {/if}
                        	</tbody>
                    </table>
					</div>
                    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
					<textarea id="textarea-content" name="textarea-content" class="ckeditor" placeholder="输入你的内容">{if isset($menuRow.body)}{$menuRow.body}{/if}
					</textarea>
					<script>
                        CKEDITOR.replace( 'textarea-content' );
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