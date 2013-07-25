{include file = "m/header.tpl"}
<ul class="unstyled">
{if $purchased}
	{foreach $purchased as $key => $val}
	<li>{$val.title}</li>
	{/foreach}
{/if}
</ul>
{include file = "m/footer.tpl"}