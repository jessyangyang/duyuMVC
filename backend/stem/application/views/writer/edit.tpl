{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
		
		<div class="container">
			<div id="edit-box" class="edit-box">
				<h2>按章节依次录入文章，可在设置内添加副标题、摘要和文章标签，也可以为当前文章设置新的作者。</h2>
				<div class="edit-content">
				<form class="form-horizontal" action="/writer/edit" title="/writer/edit"  method="POST">
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
						<table id="edit-setting-table" class="table">
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
	                				<input type="radio" value="{$item.id}" id="optionRadio{$key}" name="menu-id" {if isset($menuRow.id) && $menuRow.id eq $item.id}checked{/if} class="edit-item-id" title="{$item.id}"/> {$key+1}
	                				</label>
                                    <input type="hidden" name="menuMid[]" value="{$item.id}"/>
	                			</td>
                                <td class="edit-item-title"><input type="text" value="{$item.title}" name="menuTitle[]" class="span4" placeholder="请输入文字..."/></td>
                                <td><input type="text" name='menuSort[]' class="span1 edit-title" placeholder="{$item.sort}" value="{if $item.sort eq 0}{$key+1}{else}{$item.sort}{/if}" style="margin:0;padding:0"/></td>
                                <td>
                                    <a href="/writer/edit/menu/{$item.id}" class='btn' >进入</a>
                                    <a href="javascript:void(0)" class="btn edit-delete-button">删除</a>
                                </td>
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
				<div class="edit-chapter-top">已录入章节 （{if isset($menuRow.id)}{$menuRow.sort}{else}0{/if}/{count($menuList)}）</div>
			</div>
            <div class="modal" id="edit-delete-modal" >
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>删除</h3>
                    </div>
                    <div class="modal-body">
                        <p><i class="icon-info-sign"></i>  确定删除"</p>
                    </div>
                    <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">取消</a>
                            <a href="#" title="/writer/edit/delete/" class="btn btn-primary">确定</a>
                    </div>
            </div>
            </div>
		</div>
        <script type="text/javascript" src="/js/jquery.tablednd.js"></script>
<!-- 		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet"> -->
		<!--<script type="text/javascript" src="/js/editor.js"></script>
		<script type="text/javascript" src="/js/editor_ready.js"></script>
        -->

{include file = "writer/footer.tpl"}