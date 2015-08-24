<? $this->view('header')?>
<link href="<?=base_url()?>style/denglu.css" rel="stylesheet" type="text/css" />
<?$this->view('alert')?>
<div class="indexDiv">
    <div class="heading">登　录　　(还没帐号？)</div>
    <form id="registerform" method="post" class="form-horizontal">
    	<input name="forward" type="hidden" value="<?=$this->input->get('forward')?>" />
		<input name="username" id="username"  placeholder="邮箱/用户名" type="text" />
        <input id="password" name="password" type="password" placeholder="密码" >

   	 	<div class="chose">
            <label><a href="<?=site_url()?>/signup<?if($this->input->get()){?>?<?=http_build_query((array)$this->input->get())?><?}?>">立即注册</a>　| 　 </label><a href="<?=site_url()?>/resetpassword">找回密码</a></li>
        </div>
        <div id="btn">
            <input name="login" class="btn" type="submit" value="登　录">
        </div>
    </form>
    <p>合作方登录</p>
    <br/>
        <div class="pic">
            <a href=""><img src="<?=base_url()?>image/QQ.png"></a>
            <a href="" class="pic1"><img src="<?=base_url()?>image/xinlang.png"></a>
            <a href="" class="pic1"><img src="<?=base_url()?>image/zhifubao.png"></a>
        </div>
</div>
<? $this->view('footer')?>