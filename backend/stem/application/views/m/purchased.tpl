{include file = "m/header.tpl"}
</div>
<div class="m-purchased-info">付费书籍2部，免费书籍1部，共花费12.00元</div>
<ul class="unstyled">
{if $purchased}
	{foreach $purchased as $key => $val}
	<li>{$val.title}</li>
	{/foreach}
{/if}
</ul>
{include file = "m/footer.tpl"}