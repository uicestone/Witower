<? $this->view('header') ?>
<link href="<?=base_url()?>style/gerenxinxi.css" rel="stylesheet" type="text/css" />
<style>
div.img1 ,div.font{height:18px}
.right .img3 img {  margin-top: 0px;}
.right{margin-right: 0px;float: right;  width: 80%;}
.font{margin-right: 0px;width: 80%;   font-size: 20px;padding-left: 15px;}
.font input{    font-size: 20px;margin-right: 0px;  float: left; margin-top: 0px;    border-bottom-width: 0px;    width: 100%;}
.textinfo{ background:#CCCCCC;font-size: 16px;}
.textinfohead{  display: block; 
  background: #9E9E9E;
  font-size: 20px;
  margin-left: 0px;
  padding-left: 10px;
  margin-top: 0px;
  padding-bottom: 5px;
  padding-top: 5px;  color: white;}
  #login{left: 10%;  width: 80%;  font-size: 15px;}
  #login input{font-size: 20px;}
 </style>
<div class="indexDiv">
<?=$this->view('alert')?>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="bg2" onclick="window.location.href='javascript:show()'">
        <div class="left">头像</div>
        <div class="right">
            <div class="img1" style=" height: 100%;"><?=$this->image('avatar',$this->user->id,100,false,array('class'=>'pull-right','style'=>'clear: right;margin-top: 0px;height: 100%;'))?></div>
            <div class="img3"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">昵称</div>
        <div class="right">
			 <div class="font">
			     <input type="text" name="profiles[昵称]"  value="<?=$this->user->name?>" /></div>
             <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">性别</div>
        <div class="right">
            <div class="font">
                <select name="profiles[性别]" style="width:100%;height:30px;">
			         <option value="男" <? if($profiles['性别'] == '男'): ?>selected<? endif; ?>>男</option>
			         <option value="女" <? if($profiles['性别'] == '女'): ?>selected<? endif; ?>>女</option>
			     </select>
			</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">生日</div>
        <div class="right">
            <div class="font"><input type="text" name="profiles[生日]"  value="<?=$profiles['生日']?>" />
			</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
        <!--<div class="right">1989.10.08</div>-->
    </div>
    <div class="bg2">
        <div class="left">个性签名</div>
        <div class="right">
            <div class="font"><input type="text" name="profiles[个性签名]"  value="<?=$profiles['一句话介绍']?>" />
			</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">兴趣爱好</div>
        <div class="right">
            <div class="font"><input type="text" name="profiles[兴趣爱好]"  value="<?=$profiles['兴趣爱好']?>" />
			</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">联系方式</div>
        <div class="right">
            <div class="font"></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">手机号</div>
        <div class="right">
            <div class="font"><input type="text" name="profiles[手机号]"  value="<?=$profiles['联系方式']?>" /></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">邮箱</div>
        <div class="right">
            <div class="font"><input type="text" name="profiles[邮箱]"  value="<?=set_value('user[email]',$user['email'])?>" /></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2">
        <div class="left">微信号</div><div class="right">
        <div class="font"><input type="text" name="profiles[微信号]"  value="<?=$profiles['微信号']?>" /></div>
        <div class="img2"><img src="image/right.png"></div>
    </div>
    </div>
    <div class="bg2">
        <div class="left">QQ</div><div class="right">
        <div class="font"><input type="text" name="profiles[qq]"  value="<?=set_value('profiles[qq]',$profiles['qq'])?>" /></div>
        <div class="img2"><img src="image/right.png"></div>
    </div>
    </div>
    <div class="bg2">
        <div class="left">收货地址</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[收货地址]" value="<?=$profiles['收货地址']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
	<div class="textinfohead"><strong>汇款信息</strong></div>
	<div class="textinfo">以下信息用于智塔为您兑付悬赏积分至现金，请仔细填写</div>
    <div class="bg2">
        <div class="left">真实姓名</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[收货人姓名]" value="<?=$profiles['收货人姓名']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">证件类型</div>
		<div class="right">
			<div class="font">
			     <select name="profiles[证件类型]" style="width:100%;height:30px;" >
			         <option value="居民身份证" <? if($profiles['证件类型'] == '居民身份证'): ?>selected<? endif; ?>>居民身份证</option>
			         <option value="军官证" <? if($profiles['证件类型'] == '军官证'):  ?>selected<? endif; ?>>军官证</option>
			         <option value="护照" <? if($profiles['证件类型'] == '护照'):  ?>selected<? endif; ?>>护照</option>
			         <option value="港澳通行证" <? if($profiles['证件类型'] == '港澳通行证'):  ?>selected<? endif; ?>>港澳通行证</option>
			         <option value="外国人居留证" <? if($profiles['证件类型'] == '外国人居留证'):  ?>selected<? endif; ?>>外国人居留证</option>
			         <option value="海员证" <? if($profiles['证件类型'] == '海员证'):  ?>selected<? endif; ?>>海员证</option>
			     </select>
			</div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">证件号码</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[证件号码]" value="<?=$profiles['证件号码']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">开户银行</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[开户银行]" value="<?=$profiles['开户银行']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">银行帐号</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[银行帐号]" value="<?=$profiles['银行帐号']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">详细地址</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[详细地址]" value="<?=$profiles['详细地址']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">联系电话</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[联系电话]" value="<?=$profiles['联系电话']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">邮政编码</div>
		<div class="right">
			<div class="font"><input type="text"  name="profiles[邮政编码]" value="<?=$profiles['邮政编码']?>" /></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
	<div class="textinfohead"><strong>修改密码</strong></div>
    <div class="bg2">
        <div class="left">当前密码</div>
		<div class="right">
			<div class="font"><input type="password" name="password" autocomplete="off"></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">新密码</div>
		<div class="right">
			<div class="font"><input type="password" name="password_new"></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
    <div class="bg2">
        <div class="left">确认密码</div>
		<div class="right">
			<div class="font"><input type="password" name="password_new_confirm" ></div>
			<div class="img2"><img src="image/right.png"></div>
		</div>
    </div>
</div>
<div class="control" style="bottom: 0px;  position: fixed;  left: 0;  width: 100%; z-index:999;">
		<button type="submit" name="submit" value="1" style="  background: #08c; width: 100%;" class="btn btn-primary">保存</button>
</div>

<div id="login" style="bottom:30%;height: 45%;" >
    <div class="bt" id="bt2" style="  margin-top: 5%;  margin-bottom: 5%;">
		<input type="file" style="  width: 90%;  font-size: 20px; margin-left: 5%" name="avatar">
    </div>
    <div class="bt" id="bt2" style="margin-top: 5%; ">
		<button type="submit" style="  width: 90%;   font-size: 20px; margin-left: 5%" name="submit" class="btn btn-primary">保存</button>    </div>
    <div class="bt" id="bt3" style=" margin-top: 5%; ">
        <form action="" method="post" class="btn2">
            <input name="" style="  width: 90%;  font-size: 20px; margin-left: 5%" class="btn" type="submit" value="取消">
        </form>
    </div>
</div>
<div id="over"></div>
</form>

<script type="text/javascript">
    /*
     var x_max = $(window).width();
     var y_max = $(window).height();
     var div_width = $("#login").width() + 20;//20是边框
     var div_height = $("#login").height() + 20;
     var _x_max = x_max - div_width;//最大水平位置
     var _y_max = y_max - div_height;//最大垂直位置
     */
    function show()
    {
        // var x = (x_max - div_width) / 2;//水平居中
        //var y = (y_max - div_height) / 2;//垂直居中
        $("#login").css({"left": '10%'});//设置初始位置,防止移动后关闭再打开位置在关闭时的位置
        $("#login").css("display","block");
        $("#over").css("display","block");
    }
    function hide()
    {
        $("#login").css("display","none");
        $("#over").css("display","none");
    }
</script>
<?$this->view('footer')?>
<div style="  height: 40px;
  display: block;">
</div>
