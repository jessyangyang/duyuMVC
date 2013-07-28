{include file = "m/header.tpl"}
</div>
    <article>
        {if isset($book)}
        <div id="article-cover">
            <div class="article-cover-left">
                <img src="{$book.cover}"/>
            </div>
            <div class="article-cover-center">
                <h2>{$book.title}</h2>
                <h5>{$book.author}</h5>
                <span class="article-cover-span">{$book.name}</span>
                <span>{$book.copyright}</span>
             </div>
             <div class="article-cover-right">
                <span>￥{$book.price}</span>{if isset($purchased) && in_array($book.bid,$purchased) || $book.price eq 0}<a href="http://api.duyu.cc/api/store/download/book/{$book.bid}" class='btn'>阅读</a>{else}<a href="/m/payment/{$book.bid}" class='btn'>购买</a>{/if}
             </div>
        </div>
        <div id="article-summary">
            <h3>导言</h3>
            <p>{$book.summary}</p>
            <a href=""></a>
        </div>
        <div id="article-menu">
            <h3>目录</h3>
            {if isset($menus)}
            <ul class="unstyled">
                {foreach $menus as $key => $menu}
                <li>{$menu.title}</li>
                {/foreach}
            </ul>
            {/if}
            <a href=""></a>
        </div>
        <div id="article-info">
            <h3>信息</h3>
            <ul class="unstyled">
                <li><span>体裁</span> {$book.name}</li>
                <li><span>版权</span> {$book.copyright}</li>
                <li><span>标签</span> {$book.tags}</li>
                <li><span>设计</span> {$book.designer}</li>
                <li><span>校对</span> {$book.proofreader}</li>
                <li><span>字数</span> {$book.wordcount}</li>
                <li><span>上架</span> {$book.dateline}</li>
            </ul>
            <a href=""></a>
        </div>
        {/if}
    </article>
{include file = "m/footer.tpl"}