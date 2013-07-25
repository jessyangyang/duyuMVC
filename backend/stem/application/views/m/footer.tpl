        <footer>
        	<ul class="unstyled inline info">
        		{if isset($user) && $user}
        		<li>{$user->username}</li>
        		<li><a href="/m/user/logout">退出</a></li>
        		{/if}
        		<li> | </li>
        		<li><a href="">手机版</a></li>
        		<li> | </li>
        		<li><a href="">网页版</a></li>
        		<div id="footer">©2013 Duyupress.com</div>
        	</ul>
        </footer>
        <!-- Javascript
        =============================================== -->

        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="/js/jquery.form.js"></script>
        <script type="text/javascript" src="/js/jquery.ajax.js"></script>
        <script type="text/javascript" src="/js/action.js"></script>

    </body>
</html>