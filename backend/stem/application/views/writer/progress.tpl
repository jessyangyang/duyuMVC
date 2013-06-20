<body>    
    <header>
            <div class="right-tools">
                <ul class="inline">
                {if $member}
                    <li><a href="" title="{$member->email}">{$member->username}</a></li>
                    <li> | </li>
                    <li><a href="">帮助</a></li>
                    <li><a href="">设置</a></li>
                    <li><a href="/writer/index/logout/0">退出</a></li>
                {else}
                    <li><a href="/writer/index">主页</a></li>
                {/if}
                </ul>
            </div>
            {if is_array($topButton)}
                <div class="right-button inline">
                {foreach $topButton as $key => $item}
                <a href="{if !isset($item.url)}javascript:void(0){else}{$item.url}{/if}" class="btn {if isset($item.type)}{$item.type}{/if} {if isset($item.action)}{$item.action}{/if}">{$item.name}</a>
                {/foreach}
                </div>
            {/if}
            
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point' style="left: {$progress-4}%"></div>
                    <div class="progress">
                        <div class="bar" style="width:{$progress}%"></div>
                    </div>
                </div>
                <ul class="inline">
                    <li><a href="/writer/index">基本信息</a></li>
                    <li><a href="/writer/edit">文章录入</a></li>
                    <li><a href="/writer/cover">封面设计</a></li>
                    <li><a href="/writer/end">撰写导言</a></li>
                </ul>
            </div>
        </header>