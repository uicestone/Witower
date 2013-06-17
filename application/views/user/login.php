<?$this->view('header')?>

<div class="page-register">
	<div class="title">
		<h1>登录</h1>
	</div>
	<div class="main">
		<div id="left"><img src="/style/register-banner.png"></div>
		<div id="right">
			<form name="box-login" action="/login" method="post">
				<ul>
					<li><span>用户名/E-mail：</span><input name="username" tabindex="3" id="email"  type="text" class="inp_txt" /></li>
					<li><span>密码：</span><input name="password" tabindex="4" id="password" type="password" class="inp_txt" /></li>
					<li><span></span><input name="login" tabindex="8" type="submit" value="登录" class="btn_inp btn-c" /><label><a href="/user/signup">没有账号，立即注册。</a></label></li>
				</ul>
			</form>
		</div>
	</div>
</div>

<div class="c-b"></div>
<?$this->view('footer')?>
