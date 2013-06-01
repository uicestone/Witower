<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?=$navtitle?> <?=$setting['site_name']?> <?=$setting['seo_title']?></title>
		<meta name="keywords" content="<?=$setting['seo_keywords']?>" />
		<meta name="description" content="<?=$setting['seo_description']?>" />
		<base href="<?=$this->config->item('site_url')?>/" />
		<link rel="stylesheet" type="text/css" href="style/base.css">
		<link rel="stylesheet" type="text/css" href="style/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style/tango/skin.css">
		<link rel="stylesheet" type="text/css" href="style/common.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css">


		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>
		<!--<script type="text/javascript" src="style/bootstrap/js/bootstrap.js"></script>-->
		<script type="text/javascript" src="js/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
		<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div class="logo"><img src="style/logo.gif"></div>
				<div class="menu">
					<ul>
						<li><a href="/">首页</a></li>
						<li><a href="/project">项目</a></li>
						<li><a href="/vote">投票</a></li>
						<!--<li><a href="#">案例</a></li>-->
					</ul>
				</div>
				<div class="login">
					<ul>
						<!--{if $user[uid]}-->
						<li><a href="/home"><?=$user[nicname]?></a> |</li>
						<li><a href="/message">消息</a>|</li>
						<li><a href="/score">积分</a>|</li>
						<li><a href="/profile">个人资料</a>|</li>
						<!--{if $user[groupid]==99}-->
						<li><a href="/user/management">我的项目</a>|</li>
						<!--{/if}-->
						<!--{/if}-->
						<!--li><a href="#">帮助</a></li-->

						<!--{loop $article_header_list $key $value}-->
						<!--{if $key==0}-->
						<li><a href="index.php?help-content-<?=$value[id]?>"><?=$value[title]?></a></li>
						<!--{else}-->
						<li>|<a href="index.php?help-content-<?=$value[id]?>"><?=$value[title]?></a></li>
						<!--{/if}-->
						<!--{/loop}-->
					</ul>
					<!--{if $user[uid]}-->
					<span>
						<a href="/logout">退出</a>
					</span>
					<!--{else}-->
					<span>
						<a href="/signup">注册</a>
						<a href="/login">登录!</a>
					</span>
					<!--{/if}-->

				</div>
			</div>