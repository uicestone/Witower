<?$this->view('header')?>
<div class="page-register">
	<div class="title">
		<h1>注册</h1>
	</div>
	<div class="main">
		<div id="left"><img src="style/register-banner.png"></div>
		<div class="pull-left">
			<form id="registerform" method="post" action="/signup" class="form-horizontal">
				<input name="forward"   type="hidden" value='<?//=$forward?>' />
				<div class="control-group">
					<label class="control-label" for="email">E-mail：</label>
					<div class="controls">
						<input name="email" id="email" type="text" value="<?=set_value('email')?>" />
						<span class="label label-important"><?=form_error('email')?></span>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label" for="username">用户名：</label>
					<div class="controls">
						<input name="username" id="username"  type="text" value="<?=set_value('username')?>" />
						<span class="label label-important"><?=form_error('username')?></span>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label" for="password">密码：</label>
					<div class="controls">
						<input name="password" id="password"  type="password" />
						<span class="label label-important"><?=form_error('password')?></span>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label" for="repassword">确认密码：</label>
					<div class="controls">
						<input name="repassword" id="repassword"  type="password" />
						<span class="label label-important"><?=form_error('repassword')?></span>
					</div>
				</div>				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox" for="agree">
							<input name="agree" id="agree" type="checkbox"<?=set_checkbox('agree','on')?> />
							<span>同意"<a href="#" target="_blank">Witower智塔用户协议</a>"</span>
							<span class="label label-important"><?=form_error('agree')?></span>
						</label>
					</div>
				</div>				
				<div class="control-group">
					<div class="controls">
						<button name="signup" type="submit" class="btn btn-primary">注册</button>
						<label class="checkbox inline"><a href="/login">已有账号，立即登录</a></label>
					</div>
				</div>				
			</form>
		</div>
	</div>
</div>
<div class="c-b"></div>
<?$this->view('footer')?>
