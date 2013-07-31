        <footer>
        	<ul class="unstyled inline info">
        		{if isset($user) && $user}
        		<li class="user">{$user->username}</li>
        		<li><a href="/user/logout">退出</a></li>
                <li>|</li>
                {else}
                <li><a href="/user/login">登录</a></li>
                <li>|</li>
        		{/if}
        		<li class="user">手机版</li>
        		<div id="footer">©2013 Duyupress.com</div>
        	</ul>
        </footer>
        <!-- Javascript
        =============================================== -->

        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="/js/jquery.form.js"></script>
        <script type="text/javascript" src="/js/jquery.ajax.js"></script>
        <script type="text/javascript" src="/js/m.js"></script>
        <link href="/css/fixed.css" rel="stylesheet">
    </body>
</html>