{include file = "index/header.tpl"}
</div>
    <article>
        {if isset($book)}
        <div id="article-cover">
            <div class="article-cover-left">
                <img src="{$book.cover}" class="retina"/>
            </div>
            <div class="article-cover-center">
                <h2>{$book.title}</h2>
                <p><span>作者</span> {$book.author}</p>
                <p><span>体裁</span> {$book.name}</p>
                <p><span>版权</span> {$book.copyright}</p>
                <div class="article-cover-right">
                {if isset($purchased) && in_array($book.bid,$purchased) || $book.price eq 0}<a href="http://api.duyu.cc/api/store/download/book/{$book.bid}" class='btn-pay'>阅读</a>{else}<p class="price">{$book.price} 元</p><a href="/payment/{$book.bid}" class='btn-pay'>购买全本</a>{/if}
             </div>
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
{include file = "index/footer.tpl"}