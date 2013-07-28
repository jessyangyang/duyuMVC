{include file = "m/header.tpl"}
    <nav>
        <div id="nav-menus">
        	{if $menus}
        	{foreach $menus as $key => $menu}
            {assign var='i' value = $key + 1}<a href="/m/index/{$menu.action}" {if $current eq $menu.action}class="current"{/if}><div class="nav-menu-item {if $i eq count($menus)}nav-item-right{/if}">{$menu.name}</div></a>{/foreach}
            {/if}
        </div>
    </nav>
    </div>
    <article>
        {foreach $books as $key => $book}
        <section id="book-item-{$key}" class="row book-item-article" data="/m/book/{$book.cover}">
            <div class="book-section-left">
                <a href="/m/book/{$book.bid}"><img src="{$book.cover}"/></a>
            </div>
            <div class="book-section-right">
                 <a href="/m/book/{$book.bid}"><h3>{$book.title}</h3></a>
                <h5>{$book.author}</h5>
                <span>{$book.price}</span>
                <p>{$book.summary|truncate:70:"...":true}</p>
            </div>
        </section>
        {/foreach}
    </article>
{include file = "m/footer.tpl"}