{include file = "index/header.tpl"}
</div>
    {if $action eq login}
    <form action="/user/login" method="POST" class="form-vertical" id="user">
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
            <span class="add-on">邮箱</span><input type="text" name="email" class="span5">
            </div>
            <div class="input-prepend">
            <span class="add-on">密码</span><input type="password" name="password" class="span5">
            </div>
        </div>
    </div>
    <div class="control-group">
        <button class="btn-user" type="submit">登 录</button>
    </div>
    <div class="control-group">
        <p class="weibo-block">
            <a href="{$weibo_url}">用微博帐号注册</a>
        </p>
    </div>
    </form>
    {elseif $action eq 'register'}
    <form action="/user/register" method="POST" class="form-vertical" id="user">
        <div class="control-group">
        <div class="controls">
            <input type="text" name="email" placeholder="填写你的邮箱（用作蠹鱼帐号）" class="span5">
            <input type="password" name="password" placeholder="设一个登录密码（不少于6位）" class="span5">
        </div>
        <div class="controls">
            <button class="btn btn-large" type="submit">登录</button>
        </div>
    </div>
    </form>
    {/if}
{include file = "index/footer.tpl"}