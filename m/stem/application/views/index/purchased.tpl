{include file = "index/header.tpl"}
</div>
{if $purchased}
<div class="m-purchased-info row">付费书籍{$count.purchased}部，免费书籍{$count.download}部，共花费{$count.count}元</div>
<ul class="unstyled m-purchased-ul row">
	{foreach $purchased as $key => $val}
	<li>
        <div class="m-purchased-left fl"><h4>{$val.title}</h4></div>
        <div class="m-purchased-right text-r fl"><span>{$val.price}</span><p>{date("Y年m月d日 h:i",$val.published)}</p></div>
    </li>
	{/foreach}
</ul>
{else}
<div class="m-purchased-message">你尚未购买任何内容</div>
{/if}
{include file = "index/footer.tpl"}