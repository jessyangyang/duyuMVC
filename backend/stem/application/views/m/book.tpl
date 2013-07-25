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
                <a href="" class='btn'>￥{$book.price}</a>
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
                <li>体裁 : {$book.name}</li>
                <li>版权 : {$book.copyright}</li>
                <li>标签 : {$book.tags}</li>
                <li>设计 : {$book.designer}</li>
                <li>校对 : {$book.proofreader}</li>
                <li>字数 : {$book.wordcount}</li>
                <li>上架 : {$book.dateline}</li>
            </ul>
            <a href=""></a>
        </div>
        {/if}
    </article>
{include file = "m/footer.tpl"}