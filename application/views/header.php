<!DOCTYPE html>
<?php error_reporting(E_ALL & ~E_NOTICE);?>
<html lang="zh-CN" xmlns:wb="http://open.weibo.com/wb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>手机智塔</title>
<meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1">
<link href="<?=base_url()?>style/main.css" rel="stylesheet" type="text/css" />

<link href="<?=base_url()?>style/media.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?=site_url()?>js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/bootstrap.min.js"></script>		
		<script type="text/javascript" src="<?=site_url()?>js/jquery.masonry.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="<?=site_url()?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/common.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>script/easing.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>script/js.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>script/fun.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>script/form.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>script/jquery.SuperSlide.2.1.1.js"></script>
</head>

<body>
<div class="head">
     <a href="" class="logo"><img src="<?=base_url()?>image/logo.png" height="28"/></a>
     <div class="info">

         <div class="fl">
         	<ul>
						<?php if($this->user->isLogged()){ ?>
						<li><a href="<?=site_url()?>home"><?=$this->user->name?></a> |
						<a href="<?=site_url()?>profile">资料</a>|
						<a href="<?=site_url()?>finance">积分</a>|
						<?php if($this->user->isLogged('witower')){ ?>
						<a href="<?=site_url()?>admin">管理</a>|<?//TODO ����������ҳ?>
						<?php	}elseif($this->user->isCompany()){ ?>
						<li><a href="<?=site_url()?>company/product">管理</a>|</li><?//TODO ��ҵ������ҳ?>
						<?php	}?>
						<?php } ?>
						<?php if($this->user->isLogged()){ ?>

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
<style>
.bg1 .bg1onnow{ background: #e9a422;color: #FFF;padding: 0px 5px;}
.nav .onnow a{background: #00a0e9; color: #FFF;}

</style>
<div class="nav" style="margin-bottom: 0px;">
     <ul>
       <li ><a href="<?=site_url()?>">首页</a></li>
       <li <?if(uri_string()==='project') { ?>class="onnow"<?}?>><a href="<?=site_url()?>project">浏览项目</a></li>
       <li <?if(uri_string()==='vote') { ?> class="onnow"<?}?>><a href="<?=site_url()?>vote">发起投票</a></li>
       <li <?if(uri_string()==='piece') { ?> class="onnow"<?}?>><a href="<?=site_url()?>piece">作品</a></li>
     </ul>
</div>
<div class="hx"></div>