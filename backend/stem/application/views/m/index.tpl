{include file = "m/header.tpl"}
    <nav>
        <ul class="inline">
        	{if $menus}
        	{foreach $menus as $key => $menu}
            <li><a href="/m/index/{$menu.action}">{$menu.name}</a></li>
            {/foreach}
            {/if}
        </ul>
    </nav>
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
                <p>{$book.summary}</p>
            </div>
        </section>
        {/foreach}
    </article>
{include file = "m/footer.tpl"}