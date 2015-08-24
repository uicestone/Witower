<? $this->view('header') ?>
<link href="<?=base_url()?>style/gerenxinxi.css" rel="stylesheet" type="text/css" />
<div class="indexDiv">
<?=$this->view('alert')?>
    <div class="bg2" onclick="window.location.href='javascript:show()'">
        <div class="left">头像</div>
        <div class="right">
            <div class="img1"><?=$this->image('avatar',$this->user->id,30,false,array('class'=>'pull-right','style'=>'clear: right;'))?></div>
            <div class="img3"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">帐号</div>
        <div class="right">
            <div class="font2">958888888</div>
        </div>
    </div>
		<? print_r($getProfiles); ?>
		<? print_r($this->user->id); ?>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">昵称</div>
        <div class="right">
            <div class="font"><?=$this->user->name?></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">性别</div>
        <div class="right">
            <div class="font"><?=radio(array('男','女'), 'profiles[性别]', set_value('profiles[性别]',$profiles['性别']))?></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">生日</div>
        <div class="right">
            <div class="font">958888888</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
        <!--<div class="right">1989.10.08</div>-->
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">个性签名</div>
        <div class="right">
            <div class="font">路飞海贼王大人</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">兴趣爱好</div>
        <div class="right">
            <div class="font">篮球、足球、橄榄球</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">联系方式</div>

    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">手机号</div>
        <div class="right">
            <div class="font">13052145782</div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">邮箱</div>
        <div class="right">
            <div class="font"><?=set_value('user[email]',$user['email'])?></div>
            <div class="img2"><img src="image/right.png"></div>
        </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">微信号</div><div class="right">
        <div class="font">123456789</div>
        <div class="img2"><img src="image/right.png"></div>
    </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">QQ</div><div class="right">
        <div class="font"><?=set_value('profiles[qq]',$profiles['qq'])?></div>
        <div class="img2"><img src="image/right.png"></div>
    </div>
    </div>
    <div class="bg2" onclick="window.location.href=''">
        <div class="left">收货地址</div><div class="right">
        <div class="font">吉林省长春市吉林大学</div>
        <div class="img2"><img src="image/right.png"></div>
    </div>
    </div>
</div>
<div id="login" >
    <div class="bt" id="bt1" style="width:10%;">
        <form action="" method="post" class="btn2">
            <input name="" class="btn1" type="submit" value="拍照">
        </form>
    </div>
    <div class="bt" id="bt2" style="width:10%;">
        <form action="" method="post" class="btn2">
            <input name="" class="btn" type="submit" value="从手机相册选择">
        </form>
    </div>
    <div class="bt" id="bt3" style="width:10%;">
        <form action="" method="post" class="btn2">
            <input name="" class="btn" type="submit" value="取消">
        </form>
    </div>
</div>
<div id="over"></div>

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
        $("#login").css({"left": 0 + 'px',"bottom": 45+ 'px'});//设置初始位置,防止移动后关闭再打开位置在关闭时的位置
        $("#login").css("display","block");
        $("#over").css("display","block");
    }
    function hide()
    {
        $("#login").css("display","none");
        $("#over").css("display","none");
    }
</script>
	<div id="left" class="span9">
		<form method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class="model model-b tab-content">
				<?=$this->view('alert')?>
				<div id="avatar" class="main tab-pane active">
					<div class="warning">
						<p>注：仅支持JPG图片文件</p>
					</div>
					<div>
						<div class="model-lr model-uploadPhoto">
							<div class="pull-left">
								<input type="file" name="avatar">
							</div>
							<div class="pull-right">
								<p>您上传的头像会自动生成三种尺寸，请注意中小尺寸
									的头像是否清晰。</p>
<?if(file_exists('./uploads/images/avatar/'.$this->user->id.'.jpg')){?>
								<?=$this->image('avatar',$this->user->id,200,false,array('class'=>'pull-left'))?>
								<?=$this->image('avatar',$this->user->id,100,false,array('class'=>'pull-right'))?>
								<?=$this->image('avatar',$this->user->id,30,false,array('class'=>'pull-right','style'=>'margin-top: 30px; clear: right;'))?>
<?}?>
							</div>
						</div>
					</div>
				</div>
				<div id="baseinfo" class="main tab-pane">
					<div class="warning">
						以下信息将显示在个人资料页，方便大家了解你，注*为必填项
					</div>
					<div class="control-group">
						<label class="control-label">真实姓名：</label>
						<input type="text" name="profiles[真实姓名]" value="<?=set_value('profiles[真实姓名]',$profiles['真实姓名'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">所在地：</label>
						<select name="profiles[省市]">
							<?=options(array('上海'), set_value('profiles[省市]',$profiles['省市']), '省市')?>
						</select>
						<select name="profiles[地区]">
							<?=options(array('徐汇','浦东','黄浦','静安','普陀','闸北','杨浦','虹口','宝山','嘉定','青浦','闵行','松江','奉贤'), set_value('profiles[地区]',$profiles['地区']),'地区')?>
						</select>
					</div>
					<div class="control-group">
						<label class="control-label">*性别：</label>
						<div class="btn-group" data-toggle="buttons-radio">
							<span class="hide"><?=radio(array('男','女'), 'profiles[性别]', set_value('profiles[性别]',$profiles['性别']))?></span>
							<button type="button" checked="checked" name="profiles[性别]" class="btn<?if(set_value('profiles[性别]',$profiles['性别'])==='男'){?> active<?}?>">男</button>
							<button type="button" name="profiles[性别]" class="btn<?if(set_value('profiles[性别]',$profiles['性别'])==='女'){?> active<?}?>">女</button>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">联系邮箱：</label><input type="text" name="user[email]" value="<?=set_value('user[email]',$user['email'])?>">
						<!--<a href="/profile#email">修改安全邮箱</a> <span>关注我的人可见</span>-->
					</div>
					<div class="control-group">
						<label class="control-label">QQ：</label><input type="text" name="profiles[qq]" value="<?=set_value('profiles[qq]',$profiles['qq'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">MSN：</label><input type="text" name="profiles[msn]" value="<?=set_value('profiles[msn]',$profiles['msn'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">一句话介绍：</label><textarea name="profiles[一句话介绍]" rows="5"><?=set_value('profiles[一句话介绍]',$profiles['一句话介绍'])?></textarea>
					</div>
				</div>
				<div id="education" class="main tab-pane">
					<div class="warning">
						<p>以填写教育信息将会显示在你的个人资料页，还能帮助企业及会员在微博上快速了解彼此，注*为必填项</p>
					</div>

					<div class="control-group">
						<label class="control-label">*所在地：</label>
						<select name="profiles[学校省市]">
							<?=options(array('上海'), set_value('profiles[学校省市]',$profiles['学校省市']), '省市')?>
						</select>
						<select name="profiles[学校地区]">
							<?=options(array('徐汇','浦东','黄浦','静安','普陀','闸北','杨浦','虹口','宝山','嘉定','青浦','闵行','松江','奉贤'), set_value('profiles[学校地区]',$profiles['学校地区']),'地区')?>
						</select>
					</div>
					<div class="control-group">
						<label class="control-label">学校名称：</label>
						<input type="text" name="profiles[学校名称]" value="<?=set_value('profiles[学校名称]',$profiles['学校名称'])?>" />
					</div>
					<div class="control-group">
						<label class="control-label">入学年份：</label>
						<input type="text" name="profiles[入学年份]" value="<?=set_value('profiles[入学年份]',$profiles['入学年份'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">院系：</label><input type="text" name="profiles[院系]" value="<?=set_value('profiles[院系]',$profiles['院系'])?>">
					</div>
				</div>
				<div id="career" class="main tab-pane">
					<div class="warning">
						<p>以下信息将显示在你的个人资料页，方便大家了解你，注*为必填项</p>
					</div>

					<div class="control-group">
						<label class="control-label">* 所在地：</label>
						<select name="profiles[工作省市]">
							<?=options(array('上海'), set_value('profiles[工作省市]',$profiles['工作省市']), '省市')?>
						</select>
						<select name="profiles[工作地区]">
							<?=options(array('徐汇','浦东','黄浦','静安','普陀','闸北','杨浦','虹口','宝山','嘉定','青浦','闵行','松江','奉贤'), set_value('profiles[工作地区]',$profiles['工作地区']),'地区')?>
						</select>
					</div>
					<div class="control-group">
						<label class="control-label">* 单位名称：</label><input type="text" name="profiles[单位名称]" value="<?=set_value('profiles[单位名称]',$profiles['单位名称'])?>" />
					</div>
					<div class="control-group">
						<label class="control-label">* 职位/部门：</label><input type="text" name="profiles[职位]" value="<?=set_value('profiles[职位]',$profiles['职位'])?>" >
					</div>
				</div>
				<div id="address" class="main tab-pane">
					<div class="warning">
						<p>如果你在智塔活动中获得了奖品或者获得奖金，我们将按照以下收货人信息发送奖品或者汇款到你指定的银行账
							户，所以请填写真实的收货信息，注*为必填项。</p>
					</div>

					<div class="control-group">
						<label class="control-label">* 收货人姓名：</label><input type="text" name="profiles[收货人姓名]" value="<?=set_value('profiles[收货人姓名]',$profiles['收货人姓名'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 证件类型：</label>
						<select name="profiles[证件类型]">
							<?=options(array('身份证','军官证','港澳台胞证','护照'), set_value('profiles[证件类型]',$profiles['证件类型']),'证件类型')?>
						</select>

					</div>
					<div class="control-group">
						<label class="control-label">* 证件号码：</label><input type="text" name="profiles[证件号码]" value="<?=set_value('profiles[证件号码]',$profiles['证件号码'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 开户银行：</label>
						<input type="text" name="profiles[开户银行]" value="<?=set_value('profiles[开户银行]',$profiles['开户银行'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 银行账号：</label>
						<input type="text" name="profiles[银行账号]" value="<?=set_value('profiles[银行账号]',$profiles['银行账号'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 所在地：</label>
						<select name="profiles[邮寄省市]">
							<?=options(array('上海'), set_value('profiles[邮寄省市]',$profiles['邮寄省市']), '省市')?>
						</select>
						<select name="profiles[邮寄地区]">
							<?=options(array('徐汇','浦东','黄浦','静安','普陀','闸北','杨浦','虹口','宝山','嘉定','青浦','闵行','松江','奉贤'), set_value('profiles[邮寄地区]',$profiles['邮寄地区']),'地区')?>
						</select>
					</div>
					<div class="control-group">
						<label class="control-label">* 详细地址：</label><input type="text" name="profiles[详细地址]" value="<?=set_value('profiles[详细地址]',$profiles['详细地址'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 邮政编码：</label><input type="text" name="profiles[邮政编码]" value="<?=set_value('profiles[邮政编码]',$profiles['邮政编码'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 联系电话：</label><input type="text" name="profiles[联系电话]" value="<?=set_value('profiles[联系电话]',$profiles['联系电话'])?>">
					</div>
					<div class="control-group">
						<label class="control-label">* 送货时间：</label>
						<select name="profiles[送货时间]">
							<?=options(array('工作日','双休日','不限'), set_value('profiles[送货时间]',$profiles['送货时间']),'送货时间')?>
						</select>
					</div>
				</div>
                <div class="form-actions">
					<div class="control">
						<button type="submit" name="submit" class="btn btn-primary">保存</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
$(function(){

	$(':input').on('change',function(){
		$(this).attr('changed','changed');
	});

	$('.btn-group>:button').on('click',function(){
		$(this).siblings(':button').removeAttr('changed');
		$(this).attr('changed','changed');
		$(this).parent().find(':radio[name="'+$(this).attr('name')+'"][value="'+$(this).text()+'"]').prop('checked',true).trigger('change');
	});

	$('form').on('submit',function(){
		$(this).find(':input:not([changed]):not([name="submit"])').prop('disabled',true);
	});

	//http://stackoverflow.com/questions/7862233/twitter-bootstrap-tabs-go-to-specific-tab-on-page-reload
	if (window.location.hash) {
		$('.nav-pills a[href='+window.location.hash+']').tab('show') ;
	}

	// Change hash for page-reload
	$('.nav-pills a').on('shown', function (e) {
		window.location.hash = e.target.hash;
	});

});
</script>
<?$this->view('footer')?>