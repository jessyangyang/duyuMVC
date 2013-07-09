{include file = "writer/header.tpl"}
{include file = "writer/progress.tpl"}
        
        <div class="container">
            <div class="edit-box">
                <div id="edit-box" class="edit-info">
                <form action="/writer/index" method="POST" class="form-horizontal" >
                    <fieldset>
                    {if $islogin eq 0}
                    <div class="control-group">
                    <label class="control-label" for="">请先登录</label>
                    <div class="controls">
                        <input type="text" class="input-small" name="email" placeholder="邮件">
                        <input type="password" class="input-small" name="password" placeholder="密码">
                    </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                    <label class="checkbox">
                    <input type="checkbox"> 记住我
                    </label>
                    <input type="hidden" value="index" name="state"/>
                    <button type="submit" class="btn btn-commit">登录</button>
                    </div>
                    </div>
                    {else}
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>分类</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                            {foreach $list as $key => $item}
                            <tr>
                                <td class="edit-item-id" title="{$item.bid}">{$key+1}</td>
                                <td class="edit-item-title"><a href="/writer/title/{$item.bid}">{$item.title}</a></td>
                                <td>{$item.author}</td>
                                <td>{$item.name}</td>
                                <td>{date("Y-m-d H:i",$item.published)}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn dropdown-toggle">{if $item.status eq 0}不可用{else if $item.status eq 1}等待审核{else if $item.status eq 2}审核中{else if $item.status eq 3}未发布{else if $item.status eq 4}已发布{/if} <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/writer/index/review/{$item.bid}">等待审核</a></li>
                                            <li><a href="/writer/index/inreview/{$item.bid}">审核中</a></li>
                                            <li><a href="/writer/index/unpublished/{$item.bid}">未发布</a></li>
                                            <li><a href="/writer/index/published/{$item.bid}">已发布</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0)"  class="btn edit-delete-button" data-toggle="modal">删除</a></td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    <input type="hidden" value="title" name="state"/>
                    {/if}
                    </fieldset>
                </form>
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
                            <a href="#" title="/writer/index/delete/" class="btn btn-primary">确定</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
<script type="text/javascript" src="/js/bootstrap/bootstrap.modal.js"></script>
{include file = "writer/footer.tpl"}