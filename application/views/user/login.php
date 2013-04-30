<?$this->view('header')?>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript">
var g_is_ok_email=1, g_is_ok_passwd=1;
var g_submited = false;

function check_email(email){
	$('#checkemail').fadeOut();
	var result=false;
	var email=$.trim($('#email').val());
	if (email=="" || !email.match(/^[\w\.\-]+@([\w\-]+\.)+[a-z]{2,4}$/ig)){
		g_is_ok_email=0;
		$('#checkemail').html('{lang getPassTip2}').fadeIn();
		divDance('checkemail');
	}else{
		$('#checkemail').html(" ").fadeIn();
		result=true;
		g_is_ok_email=1;
		return result;
	}
	return result;
}

function check_passwd(){
	$('#checkpasswd').fadeOut();
	var result=false;
	var passwd=$('#password').val();
	if( bytes(passwd) <1|| bytes(passwd)>32){
		$('#checkpasswd').html('{lang editPassTip1}').fadeIn();
		divDance('checkpasswd');
		g_is_ok_passwd=0;
	}else{
		$('#checkemail').html(" ").fadeIn();
		result=true;
		g_is_ok_passwd=1;
		return result;
	}
	return result;
}

function docheck(){
	if(check_email() && check_passwd()){
		if(!g_submited && g_is_ok_email && g_is_ok_passwd){
			g_submited = true;
			return true;
		}else{
			return false;
		}
	}
}

</script>
<div class="page-register">
	<div class="title">
		<h1>登录</h1>
	</div>
	<div class="main">
		<div id="left"><img src="style/default/register-banner.png"></div>
		<div id="right">
			<!--form id="registerform" method="post" action="<?=$formAction?>" onsubmit="return docheck();"-->
			<form name="box-login" action="{url user-login}" method="post" onsubmit="return docheck();">
				<ul>
					<!--{if isset($forward) && $forward }-->
					<input name="forward"   type="hidden" value='<?=$forward?>' />
					<!--{/if}-->
					<li><span>E-mail：</span><input name="email" tabindex="3" id="email"  type="text" class="inp_txt" onblur="check_email()"  maxlength="50" value="<?=$email?>"/><label id="checkemail"><font color='red'>*</font><!--*{lang registerTip3}--></label></li>
					<li><span>{lang password}：</span><input name="password" tabindex="4" id="password" type="password" class="inp_txt" onblur="check_passwd()" maxlength="32" /><label id="checkpasswd"><font color='red'>*</font><!--*{lang editPassTip1}--></label></li>
					<li><span></span><input type="hidden" id="fromuid" name="fromuid" value="<?=$fromuid?>"><input name="submit" tabindex="8" type="submit" value="{lang submit}" class="btn_inp btn-c" /><label><a href="index.php?user-register">没有账号，立即注册。</a></label></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript"> 
//$('#email').focus();
</script>
<div class="c-b"></div>
<?$this->view('footer')?>