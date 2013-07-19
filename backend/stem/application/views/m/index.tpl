{include file = "m/header.tpl"}
    <nav>
        <ul class="inline">
            <li><a href="">荐书</a></li>
            <li><a href="">排行</a></li>
            <li><a href="">免费</a></li>
        </ul>
    </nav>
    <article>
        {foreach $books as $key => $book}
        <section id="book-item-{$key}" class="row book-item-article" data="/m/book/{$book.cover}">
            <div class="span2 book-section-left">
                <img src="{$book.cover}"/>
            </div>
            <div class="span3 book-section-right">
                <h3>{$book.title}</h3>
                <h5>{$book.author}</h5>
                <span>{$book.price}</span>
                <p>{$book.summary}</p>
            </div>
        </section>
        {/foreach}
    </article>
{include file = "m/footer.tpl"}