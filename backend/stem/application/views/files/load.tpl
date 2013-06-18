{include file = "writer/header.tpl"}
<body>
    <div class="container">
         {foreach $paths as $key => $item}
         <a href="/files/send/{$files[$key]}?CKEditor=textarea-content&CKEditorFuncNum=1&langCode=zh-cn"><img src="{$item}"/></a>
         {/foreach}
    </div>
{include file = "writer/footer.tpl"}