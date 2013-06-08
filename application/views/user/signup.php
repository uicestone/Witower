<?$this->view('header')?>

<div class="page-register">
	<div class="title">
		<h1>注册</h1>
		<!--<span><img src="style/default/register-steps.png"></span>-->
	</div>
	<div class="main">
		<div id="left"><img src="style/default/register-banner.png"></div>
		<div id="right">
			<form id="registerform" method="post" action="<?=$formAction?>" >
				<ul>
					<!--{if isset($forward) && $forward }-->
					<input name="forward"   type="hidden" value='<?=$forward?>' />
					<!--{/if}-->
					<!--{if (isset($error))}-->
					<!--li id="error" style="color:red"><?=$error?></li-->
					<!--{/if}-->
					<li><span>E-mail：</span><input name="email" tabindex="3" id="email"  type="text" class="inp_txt"  maxlength="50" value="<?=$email?>"/><label id="checkemail">*{lang registerTip3}</label></li>
					<li><span>{lang userName}：</span><input name="username" tabindex="3"  id="username" type="text" maxlength="<?=$maxlength?>" class="inp_txt"  value="<?=$username?>"/><label id="checkusername">*{lang loginTip2}</label></li>
					<li><span>{lang password}：</span><input name="password" tabindex="4" id="password" type="password" class="inp_txt"  maxlength="32" /><label id="checkpasswd">*{lang editPassTip1}</label></li>
					<li><span>{lang renewPass}：</span><input name="repassword" tabindex="5" id="repassword" type="password" class="inp_txt"  maxlength="32"/><label id="checkrepasswd"></label></li>
					<!--{if $checkcode != "3"}-->
					<!--li class="yzm">
						<span>{lang verifyCode}</span>
						<input name="code" tabindex="7" type="text" id="code"  maxlength="4" onblur="check_code()" />
						<label class="m-lr8"><img id="verifycode" src="{url user-code}" onclick="updateverifycode();" /></label>&nbsp;
						<a  href="javascript:updateverifycode();">{lang codeNotClear}</a>
						<label id="checkcode">&nbsp;</label>
					</li-->
					<!--{/if}-->
					<li><span></span><input name="agree" id="agree" type="checkbox"  checked="checked" />{lang registerTip4}"<a href="{url doc-innerlink-{eval echo urlencode('{lang registerTip5}')}}" target="_blank">{lang registerTip5}</a>" <!--label id="chkagree">&nbsp;</label--></li>
					<li><span></span><input type="hidden" id="fromuid" name="fromuid" value="<?=$fromuid?>"><input name="submit" tabindex="8" type="submit" value="提交" class="btn_inp btn-c"><label><a href="index.php?user-login">已有账号，立即登录。</a></label></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<div class="c-b"></div>
<?$this->view('footer')?>