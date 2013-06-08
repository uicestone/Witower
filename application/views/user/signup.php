<?$this->view('header')?>
<div class="page-register">
	<div class="title">
		<h1>注册</h1>
		<!--<span><img src="style/register-steps.png"></span>-->
	</div>
	<div class="main">
		<div id="left"><img src="style/register-banner.png"></div>
		<div id="right">
			<form id="registerform" method="post" action="/signup">
				<ul>
					<input name="forward"   type="hidden" value='<?=$forward?>' />
					<li><span>E-mail：</span><input name="email" id="email"  type="text" class="inp_txt" /></li>
					<li><span>用户名：</span><input name="username" id="username" type="text" class="inp_txt" /></li>
					<li><span>密码：</span><input name="password" id="password" type="password" class="inp_txt" /></li>
					<li><span>确认密码：</span><input name="repassword" id="repassword" type="password" class="inp_txt" /></li>
					<li><span></span><input name="agree" id="agree" type="checkbox"  checked="checked" />同意"<a href="#" target="_blank">Witower智塔用户协议</a>" </li>
					<li><span></span><input name="signup" type="submit" value="注册" class="btn_inp btn-c" /><label><a href="/login">已有账号，立即登录</a></label></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<div class="c-b"></div>
<?$this->view('footer')?>
