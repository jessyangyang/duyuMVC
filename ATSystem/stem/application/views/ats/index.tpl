{include file = "ats/header.tpl"}
    <body>
        <header>
            <div class="right-tools">
                <a href="">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            <a href="javascript:void(0)" class="btn btn-danger right-button">下一步：撰写导言</a>
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point'></div>
                    <div class="progress">
                        <div class="bar" style="width: 0%"></div>
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
                <div id="edit-box" class="edit-info">
                <form action="/ats/index" method="POST" class="form-horizontal" >
                    <fieldset>
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
                    <input type="hidden" value="title" name="state"/>
                    <button type="submit" class="btn btn-commit">登录</button>
                    </div>
                    </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
{include file = "ats/footer.tpl"}