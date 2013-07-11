<?$this->view('header')?>

<div class="page-register">
	<div class="title">
		<h1>登录</h1>
	</div>
	<div class="main">
<?if(isset($alert) && is_array($alert)){?>
<?	foreach($alert as $alert_single){?>
		<div class="alert<?if(array_key_exists('type', $alert_single)){?><?=' '.$alert_single['type']?><?}?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?if(array_key_exists('title', $alert_single)){?><strong><?=$alert_single['title']?></strong><?}?>
			<?=$alert_single['message']?>
		</div>
<?	}?>
<?}?>
		<div id="left"><img src="/style/register-banner.png"></div>
		<div class="pull-left">
			<form id="registerform" method="post" action="/login" class="form-horizontal">
				<input name="forward"   type="hidden" value='<?//=$forward?>' />
				<div class="control-group">
					<label class="control-label" for="username">用户名/E-mail：</label>
					<div class="controls">
						<input name="username" id="username"  type="text" />
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label" for="password">密码：</label>
					<div class="controls">
						<input name="password" id="password"  type="password" />
					</div>
				</div>				
				<div class="control-group">
					<div class="controls">
						<button name="login" type="submit" class="btn btn-primary">登录</button>
						<label class="checkbox inline"><a href="/signup">没有账号，立即注册</a></label>
					</div>
				</div>				
			</form>
		</div>
	</div>
</div>

<div class="c-b"></div>
<?$this->view('footer')?>
