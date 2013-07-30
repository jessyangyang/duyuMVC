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
    <article>
        {foreach $books as $key => $book}
        <section id="book-item-{$key}" class="row book-item-article" data="/book/{$book.cover}">
            <div class="book-section-left">
                <a href="/book/{$book.bid}"><img src="{$book.cover}"/></a>
            </div>
            <div class="book-section-right">
                 <a href="/book/{$book.bid}"><h3>{$book.title}</h3></a>
                <h5>{$book.author}</h5>
                <span>{if isset($book.price) && $book.price eq 0}免费{else}{$book.price}元{/if}</span>
                <p>{$book.summary|truncate:70:"...":true}</p>
            </div>
        </section>
        {/foreach}
    </article>
{include file = "index/footer.tpl"}