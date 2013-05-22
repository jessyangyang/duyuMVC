<body>    
    <header>
            <div class="right-tools">
                <a href="">主页</a>
                <a href="">帮助</a>
                <a href="">设置</a>
            </div>
            {if is_array($topButton)}
                <div class="right-button">
                {if isset($topButton.left)}
                     <a href="{if !isset($topButton.left.url)}javascript:void(0){else}{$topButton.left.url}{/if}" class="btn fl">{$topButton.left.name}</a>
                {/if}
                {if isset($topButton.right)}
                    <a href="{if !isset($topButton.right.url)}javascript:void(0){else}{$topButton.right.url}{/if}" class="btn btn-danger btn-next">{$topButton.right.name}</a>
                {/if}
                </div>
            {/if}
            
            <div class="header-nav">
                <h1>投稿系统</h1>
                <div class="p-bar">
                    <div class='red-point'></div>
                    <div class="progress">
                        <div class="bar" style="width: 0
                        {$progress}%"></div>
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