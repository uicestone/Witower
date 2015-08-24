<?=doctype('html5')?>

<html lang="zh-CN" xmlns:wb="http://open.weibo.com/wb">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?=implode(' - ' , array_reverse(array_column($this->page_path, 'text')))?><?if($this->page_path){?> - <?}?>智塔</title>
		<meta name="keywords" content="<?=$this->config->user_item('keywords')?>" />
		<meta name="description" content="<?=$this->config->user_item('description')?>" />
		
		<link rel="icon" href="<?=site_url()?>style/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/bootstrap/datepicker.css">
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/tango/skin.css">
		<link rel="stylesheet" href="//libs.baidu.com/fontawesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/summernote.css">
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/common.css">
		<link rel="stylesheet" href="<?=site_url()?>js/MediaElement/mediaelementplayer.css" />

		<script type="text/javascript" src="<?=site_url()?>js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/bootstrap.min.js"></script>		
		<script type="text/javascript" src="<?=site_url()?>js/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/common.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/MediaElement/mediaelement-and-player.min.js"></script>
		<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="header">
			<div class="wrapper">
				<div class="logo pull-left"><img src="<?=site_url()?>style/logo.png"></div>
				<div class="menu pull-left">
					<ul class="newhaider">
						<li<?if(uri_string()==='') { ?> class="current-menu-item"<?}?>><a href="<?=site_url()?>">首页</a></li>
						<li<?if(uri_string()==='project') { ?> class="current-menu-item"<?}?>><a href="<?=site_url()?>project">浏览项目</a></li>
						<li<?if(uri_string()==='vote') { ?> class="current-menu-item"<?}?>><a href="<?=site_url()?>vote">发起投票</a></li>
						<li<?if(uri_string()==='piece') { ?> class="current-menu-item"<?}?>><a href="<?=site_url()?>piece">作品</a></li>
					</ul>
				</div>
				<div class="login pull-right">
					<ul>
						<?php if($this->user->isLogged()){ ?>
						<li><a href="<?=site_url()?>home"><?=$this->user->name?></a> |</li>
						<li><a href="<?=site_url()?>profile">资料</a>|</li>
						<li><a href="<?=site_url()?>finance">积分</a>|</li>
						<?php	if($this->user->isLogged('witower')){ ?>
						<li><a href="<?=site_url()?>admin">管理</a>|</li><?//TODO 智塔管理首页?>
						<?php	}elseif($this->user->isCompany()){ ?>
						<li><a href="<?=site_url()?>company/product">管理</a>|</li><?//TODO 企业管理首页?>
						<?php	}?>
						<?php } ?>
						<?php if($this->user->isLogged()){ ?>
						<li>
							<a href="<?=site_url()?>logout">退出</a>
						</li>
						<?php }else{ ?>
						<li>
							<a href="<?=site_url()?>signup">注册</a><a >|</a>
							<a href="<?=site_url()?>login">登录</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>       
        
		<?php if(!empty($home_slide_images)){ ?>
		<!--幻灯片切换层START-->
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/slides.css">
		<div id="slides" style="margin-top:-20px;">
			<?php foreach ($home_slide_images as $image) { ?>
				<?php if ($image->url) { ?><a href="<?= $image->url ?>" target="_blank"><?php } ?>
					<img src="<?= site_url() ?>uploads/images/banner/<?= $image->filename ?>">
					<?php if ($image->url) { ?></a><?php } ?>
			<?php } ?>
		</div>
		<!--幻灯片切换层END-->
		<?php } ?>

		<div id="content" class="wrapper<?if($this->page_name){?> page-<?=$this->page_name?><?}?>">
			<?php if(count($this->page_path)>1){ ?>
			<ul class="dh"><h2>当前位置：</h2>
					<?php foreach($this->page_path as $level => $page){ ?>
					<?php if($level===0){ ?><strong><?php } ?>
						<a href="<?=$page['href']?>"><?=$page['text']?></a>
					<?php if($level===0){ ?></strong><? } ?>
					<?php if($level < count($this->page_path) - 1){ ?><span class="divider">/</span><?php } ?>
					<?php } ?>
			</ul>
			<?php } ?>
			<div class="row-fluid">
