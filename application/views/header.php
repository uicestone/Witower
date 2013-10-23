<?=doctype('html5')?>

<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>智塔</title>
		<meta name="keywords" content="<?=$this->config->user_item('keywords')?>" />
		<meta name="description" content="<?=$this->config->user_item('description')?>" />
		
		<link rel="icon" href="/style/favicon.ico" type="image/x-icon" />
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
		<div id="header">
			<div class="wrapper">
				<div class="logo pull-left"><img src="/style/logo.gif"></div>
				<div class="menu pull-left">
					<ul>
						<li<?if(uri_string()===''){?> class="current-menu-item"<?}?>><a href="/">首页</a></li>
						<li<?if(uri_string()==='project'){?> class="current-menu-item"<?}?>><a href="/project">项目</a></li>
						<li<?if(uri_string()==='vote'){?> class="current-menu-item"<?}?>><a href="/vote">投票</a></li>
					</ul>
				</div>
				<div class="login pull-right">
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
		</div>
		
		<div id="content" class="wrapper<?if($this->page_name){?> page-<?=$this->page_name?><?}?>">
<?if(count($this->page_path)>1){?>
			<ul class="breadcrumb">
<?	foreach($this->page_path as $level => $page){?>
				<li>
					<?if($level===0){?><strong><?}?>
						<a href="<?=$page['href']?>"><?=$page['text']?></a>
					<?if($level===0){?></strong><?}?>
					<?if($level<count($this->page_path)-1){?><span class="divider">/</span><?}?>
				</li>
<?	}?>
			</ul>
<?}?>
			<div class="row-fluid">
