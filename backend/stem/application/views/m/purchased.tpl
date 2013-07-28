{include file = "m/header.tpl"}
</div>
<div class="m-purchased-info row">付费书籍2部，免费书籍1部，共花费12.00元</div>
<ul class="unstyled m-purchased-ul row">
{if $purchased}
	{foreach $purchased as $key => $val}
	<li>
        <div class="m-purchased-left fl"><h4>{$val.title}</h4></div>
        <div class="m-purchased-right text-r fl"><span>{$val.price}</span><p>{$val.published}</p></div>
    </li>
	{/foreach}
{/if}
</ul>
{include file = "m/footer.tpl"}