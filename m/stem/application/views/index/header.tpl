{*
/**
* M Views
* 
* @author   Jess<shawnisun@gmail.com>
* @version  1.0
* @license  http://wiki.duyu.com/duyuMvc
*/
*}
<!DOCTYPE html>
<html lang="zh-cn" xmlns:wb="http://open.weibo.com/wb">
    <head>
        <meta charset="utf-8">
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="description" content=""/>
        <meta name="author" content=""/>

        <!-- Base Styles -->
        <link href="/css/jquery.mobile.min.css" rel="stylesheet">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/css/m.css" rel="stylesheet">

        <!-- FOR IE6 ~ 8 support of HTML% elements -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="/js/html5.js"></script>
        <![endif]-->

        <!-- Favicon and Touch icons -->
        <!-- <link rel="shortcut icon" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href=""/> -->
        <!-- <link rel="apple-touch-icon-precomposed" href=""/> -->
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery/jquery.retina.js"></script>
        <script type="text/javascript" src="/js/jquery/jquery.mobile.custom.js"></script>
        <script type="text/javascript" src="/js/jquery/jquery.mobile.min.js"></script>
        <meta name="baidu-tc-cerfication" content="3da39df14e14b2e955b254384a50cdf1" />
    </head>
<body>
<div data-role="page" id="home">
    <div id="header" data-role="header">
    <header>
        <a href="/index"><div class="header-back retina">上一页</div></a>
        <h1>{$topTitle}</h1>
        <a href="{if isset($user->id)}/user/purchased{else}/user/login{/if}" data-transition="slideup"><div class="header-user retina">账户</div></a>
    </header>