<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>智塔</title>
		<meta name="keywords" content="<?//=$setting['seo_keywords']?>" />
		<meta name="description" content="<?//=$setting['seo_description']?>" />
		<link rel="stylesheet" type="text/css" href="/style/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/style/tango/skin.css">
		<link rel="stylesheet" type="text/css" href="/style/common.css">

		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/style/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="/js/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="/js/common.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div class="logo"><img src="/style/logo.gif"></div>
				<div class="menu">
					<ul>
						<li<?if(uri_string()===''){?> class="current-menu-item"<?}?>><a href="/">首页</a></li>
						<li<?if(uri_string()==='project'){?> class="current-menu-item"<?}?>><a href="/project">项目</a></li>
						<li<?if(uri_string()==='vote'){?> class="current-menu-item"<?}?>><a href="/vote">投票</a></li>
					</ul>
				</div>
				<div class="login">
					<ul>
<?if($this->user->isLogged()){?>
						<li><a href="/home"><?=$this->user->name?></a> |</li>
						<li><a href="/bonus">积分</a>|</li>
						<li><a href="/profile">资料</a>|</li>
<?	if($this->user->isCompany()){?>
						<li><a href="/company/product">管理</a>|</li>
<?	}?>
<?}?>
<?if($this->user->isLogged()){?>
					<li>
						<a href="/logout">退出</a>
					</li>
<?}else{?>
					<li>
						<a href="/signup">注册</a>
						<a href="/login">登录</a>
					</li>
<?}?>
					</ul>
				</div>
			</div>
