<?$this->view('header')?>
<link href="<?=base_url()?>style/zhuce.css" rel="stylesheet" type="text/css" />
<div class="indexDiv">
    <div class="heading">注&nbsp&nbsp&nbsp册</div>
    <form class="i" id="registerform" method="post" >
    	<input class="f" name="forward"   type="hidden" value='<?//=$forward?>' />
    	<input class="f" name="email" id="email" placeholder="E-mail" type="text" value="<?=set_value('email')?>" />
		<span  class="label label-important"><?=form_error('email')?></span>
        <input class="f" name="username" id="username"  placeholder="用户名" type="text" value="<?=set_value('username')?>" />
        <span class="label label-important"><?=form_error('password')?></span>
        <input class="f"  name="password" placeholder="密码" id="password"  type="password" />
        <span class="label label-important"><?=form_error('password')?></span>
        <input class="f"  name="repassword" id="repassword"  type="password" placeholder="确认密码" />
        <span class="label label-important"><?=form_error('repassword')?></span>
        <div id="y">
            <input class="f" name="captcha" id="captcha" placeholder="验证码" type="text"/>
            <span class="label label-important"><?=$captcha['image']?></span>
            <span class="label label-important"><?=form_error('captcha')?></span>
        </div>

		<div id="check">
			<input name="is_company" id="is-company" type="checkbox"<?=set_checkbox('is_company','on')?> />注册成为企业用户
		</div>
				<div id="boss" class="hide company-forms">
					<div class="control-group">
						<label class="control-label">公司简介</label>
						<div class="controls">
							<textarea name="description" id="description" disabled="disabled"><?=set_value('description')?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">联系方式</label>
						<div class="controls">
							<input type="text" name="profiles[联系方式]" id="contact" disabled="disabled"><?=set_value('profiles[联系方式]')?></textarea>
						</div>
					</div>
				</div>
    <div id="check">
          <label class="checkbox" for="agree">
							<input name="agree" id="agree" type="checkbox"<?=set_checkbox('agree','on')?> />
							<span class="user-only-forms">同意"<a href="/wit/1" target="_blank">Witower智塔用户协议</a>"</span>
							<span id="boss1" class="company-forms hide">同意"<a href="/wit/2" target="_blank">Witower智塔企业用户协议</a>"</span>
							<span class="label label-important"><?=form_error('agree')?></span>
						</label>

    </div>
	<div class="button">
		<input class=" btn" name="signup"  type="submit" value="注　　册">
	</div>

    </form>
    <div id="checkbox">
        <label class="checkbox inline"><a href="<?=site_url()?>/login<?if($this->input->get()){?>?<?=http_build_query((array)$this->input->get())?><?}?>">已有账号，立即登录</a></label>
    </div>

</div>
、<script type="text/javascript">
$(function(){
	document.getElementById("boss").style.display="none";
	document.getElementById("boss1").style.display="none";
	$('#is-company').on('change', function(){
		if($(this).is(':checked')){
			$('.company-forms').show().find(':input').prop('disabled',false);
			$('.user-only-forms').hide();
		}
		else{
			$('.company-forms').hide().find(':input').prop('disabled',true);
			$('.user-only-forms').show();
		}
	});
});
</script>
<?$this->view('footer')?>
