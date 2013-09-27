<?=doctype('html5')?>

<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>智塔</title>
		<meta name="keywords" content="<?=$this->config->user_item('keywords')?>" />
		<meta name="description" content="<?=$this->config->user_item('description')?>" />
		<link rel="stylesheet" type="text/css" href="/style/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style/bootstrap/datepicker.css">
		<link rel="stylesheet" type="text/css" href="/style/tango/skin.css">
		<link rel="stylesheet" type="text/css" href="/style/common.css">

		<script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
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
						<li><a href="/profile">资料</a>|</li>
						<li><a href="/finance">积分</a>|</li>
<?	if($this->user->isLogged('witower')){?>
						<li><a href="/admin">管理</a>|</li><?//TODO 智塔管理首页?>
<?	}elseif($this->user->isCompany()){?>
						<li><a href="/company/product">管理</a>|</li><?//TODO 企业管理首页?>
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
