        <footer data-role="footer">
        	<ul class="unstyled inline info">
        		{if isset($user) && $user}
        		<li class="user">{$user->username}</li>
        		<li><a href="/user/logout">退出</a></li>
                <li>|</li>
                {else}
                <li><a href="/user/login">登录</a></li>
                <li>|</li>
        		{/if}
        		<li class="user">蠹鱼有书</li>
                <li class="weibo_plugn"><wb:follow-button uid="2991975565" type="red_1" width="67" height="24" ></wb:follow-button></li>
        		<div id="footer">©2013 Duyupress.com</div>
        	</ul>
        </footer>
        <!-- Javascript
        =============================================== -->

        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="/js/m.js"></script>
        <link href="/css/fixed.css" rel="stylesheet">
</div>       
    </body>
</html>