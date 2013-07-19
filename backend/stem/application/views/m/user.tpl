{include file = "m/header.tpl"}
<form action="/m/user/register" method="POST" class="form-vertical">
    {if $action eq false}
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
            <span class="add-on">邮箱</span><input type="text" size="16" name="email" class="span2">
            </div>
            <div class="input-prepend">
            <span class="add-on">密码</span><input type="text" size="16" name="password" class="span2">
            </div>
        </div>
    </div>
    <div class="control-group">
        <button class="btn" type="submit">登录</button>
    </div>
    <div class="control-group">
        <p class="help-block">
            <a href="{$weibo_url}">用微博帐号注册</a>
        </p>
    </div>
    {elseif $action eq 'register'}
        <div class="control-group">
        <div class="controls">
            <input type="text" size="16" name="email" placeholder="填写你的邮箱（用作蠹鱼帐号）" class="span3">
            <input type="text" size="16" name="password" placeholder="设一个登录密码（不少于6位）" class="span3">
        </div>
        <div class="controls">
            <button class="btn" type="submit">登录</button>
        </div>
    </div>
    {/if}
</form>
{include file = "m/footer.tpl"}