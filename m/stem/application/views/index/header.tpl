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
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="description" content=""/>
        <meta name="author" content=""/>

        <!-- Base Styles -->
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
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.hotkeys.js"></script>
        <script type="text/javascript" src="/js/jquery.retina.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </head>
<body>
    <div id="header">
    <header>
        <a href="/index"><div class="header-back retina">上一页</div></a>
        <h1>{$topTitle}</h1>
        <a href="/user/login"><div class="header-user retina">账户</div></a>
    </header>