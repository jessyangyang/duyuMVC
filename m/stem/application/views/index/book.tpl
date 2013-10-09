{include file = "index/header.tpl"}
</div>
<div data-role="content">
    <article>
        {if isset($book)}
        <div id="article-cover">
            <div class="article-cover-left">
                <img src="{$book.cover}" class="retina"/>
            </div>
            <div class="article-cover-center">
                <h2>{$book.title}</h2>
                <p><span>作者</span> {$book.author}</p>
                <p><span>体裁</span> {$book.name}</p>
                <p><span>版权</span> {$book.copyright}</p>
                <div class="article-cover-right">
                {if isset($purchased) && in_array($book.bid,$purchased) || $book.price eq 0}<a href="{if $isLogin}/download/{$book.bid}{else}/user/login{/if}" class='btn-pay' rel="external" target="_blank">同步到App</a>{else}<p class="price">{$book.price} 元</p><a href="/payment/{$book.bid}" class='btn-pay' rel="external" target="_blank">购买全本</a>{/if}
             </div>
             </div>
        </div>
        <div id="article-summary">
            <h3>导言</h3>
            <p class="article-show-content">{$book.summary}</p>
            <a href="#article-summary" class="article-show-button retina">展开</a>
        </div>
        <div id="article-menu">
            <h3>目录</h3>
            {if isset($menus)}
            <ul class="unstyled article-show-content">
                {foreach $menus as $key => $menu}
                <li>{$menu.title}</li>
                {/foreach}
            </ul>
            {/if}
           <a href="#article-menu" class="article-show-button retina">展开</a>
        </div>
        <div id="article-info">
            <h3>信息</h3>
            <ul class="unstyled">
                <li><span>体裁</span> {$book.name}</li>
                <li><span>版权</span> {$book.copyright}</li>
                <li><span>标签</span> {$book.tags}</li>
                <li><span>设计</span> {$book.designer}</li>
                <li><span>校对</span> {$book.proofreader}</li>
                <li><span>字数</span> {$book.wordcount}</li>
                <li><span>上架</span> {$book.dateline}</li>
            </ul>
        </div>
        <div id="article-comment">
            <h3>书评</h3>
            <!--<script type="text/javascript">
            (function(){
                var url = "http://widget.weibo.com/distribution/comments.php?width=0&url=http%3A%2F%2Fopen.weibo.com%2Fwidget%2Fcomments.php&color=dcd9d7,f5f4f1,4c4c4c,b54434,dcd9d7,ffffff&colordiy=1&ralateuid=2905648385&appkey=3175998203&iframskin=1&dpc=1";
                document.write('<iframe id="WBCommentFrame" src="' + url + '" scrolling="yes" frameborder="0" style="width:100%"></iframe>');
            })();
            </script>
            <script src="http://tjs.sjs.sinajs.cn/open/widget/js/widget/comment.js" type="text/javascript" charset="utf-8"></script>
            <script type="text/javascript">
                window.WBComment.init({
                    "id": "WBCommentFrame"
                });
            </script>-->
        </div>
        {/if}
    </article>
</div>
{include file = "index/footer.tpl"}