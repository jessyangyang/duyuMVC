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
                                <td><a href="">{if $item.status eq 0}未发布{else}已发布{/if}</a></td>
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
{include file = "writer/footer.tpl"}