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
                            <th>发布状态</th>
                        </thead>
                        <tbody>
                            {foreach $list as $key => $item}
                            <tr>
                                <td>{$key+1}</td>
                                <td><a href="/writer/title/{$item.bid}">{$item.title}</a></td>
                                <td>{$item.author}</td>
                                <td>{$item.name}</td>
                                <td>{$item.published|date_format:"%H:%M %D"}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn dropdown-toggle">{if $item.status eq 1}未发布{else}已发布{/if} <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/writer/index/state/{$item.bid}/1">未发布</a></li>
                                            <li><a href="/writer/index/state/{$item.bid}/3">已发布</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)" id="edit-delete-button">删除</a></li>
                                                <div class="modal" id="edit-delete-modal">
                                                    <div class="modal-header">
                                                    <a class="close" data-dismiss="modal">×</a>
                                                    <h3>删除图书"{$item.title}"吗</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <a href="javascript:void(0)" class="btn">取消</a>
                                                    <a href="/writer/title/delete/{$item.bid}" class="btn btn-primary">确定</a>
                                                    </div>
                                                </div>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    <input type="hidden" value="title" name="state"/>
                    {/if}
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
<script type="text/javascript" src="/js/bootstrap/bootstrap.modal.js"></script>
{include file = "writer/footer.tpl"}