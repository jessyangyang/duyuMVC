{include file = "index/header.tpl"}
    <nav>
        <div id="nav-menus">
        	{if $menus}
        	{foreach $menus as $key => $menu}
            {assign var='i' value = $key + 1}<a href="/index/{$menu.action}" class="nav-menu-item {if $i eq count($menus)}nav-item-right{/if} {if $current eq $menu.action}current{/if}">{$menu.name}</a>{/foreach}
            {/if}
        </div>
    </nav>
</div>
<div data-role="content">
    <article>
        {foreach $books as $key => $book}
        <a href="/book/{$book.bid}" data-transition="slide">
        <section id="book-item-{$key}" class="row book-item-article" data-transition="slide">
            <div class="book-section-left">
                <img src="../img/m/cover_bg.png" class="scrollLoading" data-url="{$book.cover}"/>
            </div>
            <div class="book-section-right">
                 <h3>{$book.title}</h3>
                <h5>{$book.author}</h5>
                <span>{if isset($book.price) && $book.price eq 0}免费{else}{$book.price}元{/if}</span>
                <p>{$book.summary|truncate:50:"...":true}</p>
            </div>
        </section>
        </a>
        {/foreach}
    </article>
</div>
<script type="text/javascript" src="/js/jquery/jquery.scrollloading.min.js"></script>
{include file = "index/footer.tpl"}