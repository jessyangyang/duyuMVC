        
        <footer data-role="footer">
            <div id="app-download">
                <a href="https://itunes.apple.com/cn/artist/duyu/id641401789?mt=8">
                <div id="app-logo">
                    <div class="app-logo"></div>
                    <span>  到 App Store 下载蠹鱼阅读器。 </span>
                    <div class="app-close"></div>
                </div>
                </a>
            </div>
        	<ul class="unstyled inline info">
        		{if isset($user->id) && $user->id}
        		<li class="user">{$user->username}</li>
        		<li><a href="/user/logout">退出</a></li>
                <li>|</li>
                {else}
                <li><a href="/user/login" data-transition="slideup">登录</a></li>
                <li>|</li>
        		{/if}
        		<li class="user">蠹鱼有书</li>
                <li class="weibo_plugn"><wb:follow-button uid="2991975565" type="red_1" width="67" height="24" ></wb:follow-button></li>
        		<div id="footer">©2013 Duyupress.com</div>
        	</ul>
            <a href="#" onclick="$.mobile.silentScroll(0)"><div id="m-move-top"></div></a>


            <!-- Javascript
            =============================================== -->
            {if isset($message) && $message}
            <script type="text/javascript">
                alert('{$message}');
            </script>
            {/if}
            <!-- Placed at the end of the document so the pages load faster -->
            <script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>
            <script type="text/javascript" src="/js/m.js"></script>
            <script src="http://tjs.sjs.sinajs.cn/t35/apps/opent/js/frames/client.js" language="JavaScript"></script>
            
        </footer>
        <link href="/css/fixed.css" rel="stylesheet">
</div>
    </body>
</html>