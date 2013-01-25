<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0/">
		<meta name="description" content=""/>
		<meta name="author" content=""/>

		<!-- Base Styles -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet"/>
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet"/>

		<!-- FOR IE6 ~ 8 support of HTML% elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicon and Touch icons -->
		<link rel="shortcut icon" href=""/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href=""/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href=""/>
		<link rel="apple-touch-icon-precomposed" href=""/>
	</head>
	<body>
		<header>
			<div class="right-tools">
				<a href="">主页</a>
				<a href="">帮助</a>
				<a href="">设置</a>
			</div>
			<a href="" class="btn btn-danger right-button">下一步：撰写导言</a>
			<div class="header-nav">
				<h1>投稿系统</h1>
				<div class="p-bar">
					<div class='red-point'></div>
					<div class="progress">
						<div class="bar" style="width: 0%"></div>
					</div>
				</div>
				<ul class="inline">
					<li>基本信息</li>
					<li>文章录入</li>
					<li>封面设计</li>
					<li>撰写导言</li>
				</ul>
			</div>
		</header>
		
		<div class="container">
			<div class="edit-box">
				<h2>录入的信息包括全本作品的名称、作者、体裁以及作品标签。</h2>
				<div id="edit-box" class="edit-info">
					<form class="form-horizontal" action="" methods="">
					<fieldset>
					<div class="control-group">
					<label class="control-label" for="">作品名称：</label>
					<div class="controls">
						<input type="text" class="span5" name="title"/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作者名称：</label>
					<div class="controls">
					<input type="text" class="span5" name="author"/>
					</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="">作品体裁：</label>
					<div class="controls">
	              		<label class="checkbox inline">
	                	<input type="checkbox" value="option1" id="inlineCheckbox1"> 小说</label>
	              		<label class="checkbox inline">
						<input type="checkbox" value="option2" id="inlineCheckbox2"> 随笔</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option3" id="inlineCheckbox3"> 诗歌</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option4" id="inlineCheckbox3"> 剧本</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option5" id="inlineCheckbox3"> 文论</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option6" id="inlineCheckbox3"> 非文学</label>
						<label class="checkbox inline">
						<input type="checkbox" value="option7" id="inlineCheckbox3"> 其他</label>
	            	</div>
	            	</div>
	            	<div class="control-group">
	            	<label class="control-label" for="">作品标签：</label>
	            	<div class="controls">
					<input type="text" class="span5" name="tag" placeholder="多个标签用逗号隔开，如建筑，哥特式风格，罗马"/>
					</div>
					</div>
					</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
		<footer>
			
		</footer>
		<!-- Javascript
		=============================================== -->

		<!-- Placed at the end of the document so the pages load faster -->

		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src=""></script>
		<script src=""></script>

	</body>
</html>