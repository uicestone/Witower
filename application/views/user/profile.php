<? $this->view('header') ?>
<script type="text/javascript">
$(function(){
	$(':input').on('change',function(){
		$(this).attr('changed',true);
	});
	
	$('form').on('submit',function(){
		$(this).find(':input:not([changed], button, :file)').prop('disabled',true);
	});
});
</script>
<div id="content" class="model-view page-home">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">用户</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="#">修改头像</a>
		</li>
	</ul>
	<div id="left">
		<form method="post" enctype="multipart/form-data">
			<div class="model model-b tab-content">
				<div id="avartar" class="main tab-pane fade in active">
					<div class="warning">
						<p>注：仅支持JPG图片文件</p>
					</div>
					<div>
						<div class="model-lr model-uploadPhoto">
							<div class="fn-left">
								<input type="file" name="avartar">
							</div>
							<div class="fn-right">
								<p>您上传的头像会自动生成三种尺寸，请注意中小尺寸
									的头像是否清晰。</p>
<?if(file_exists('./uploads/images/avartar/'.$this->user->id.'.jpg')){?>
								<img src="/uploads/images/avartar/<?=$this->user->id?>_200.jpg" class="pull-left">
								<img src="/uploads/images/avartar/<?=$this->user->id?>_100.jpg" class="pull-right">
								<img src="/uploads/images/avartar/<?=$this->user->id?>_30.jpg" class="pull-right" style="margin-top: 30px;">
<?}?>
							</div>
						</div>
					</div>
				</div>
				<div id="baseinfo" class="main tab-pane fade">
					<div class="warning">
						以下信息将显示在个人资料页，方便大家了解你，注*为必填项
					</div>
					<ul>
						<li><label>*用户名：</label><input type="text" name="name" value="<?= $user['name'] ?>"></li>
						<li><label>真实姓名：</label><input type="text" name="profiles[真实姓名]" value="<?= isset($profiles['真实姓名'])?$profiles['真实姓名']:'' ?>"><span>仅自己可见</span></li>
						<li><label>所在地：</label>
							<select name="location0">
								<option>上海</option>
							</select>
							<select name="location1">
								<option>宝山区</option>
							</select>
						</li>
						<li><label>*性别：</label>
							<span class="btn-group" data-toggle="buttons-radio">
								<button type="button" name="profiles[性别]" value="男" class="btn">男</button>
								<button type="button" name="profiles[性别]" value="女" class="btn">女</button>
							</span>
						</li>
						<li><label>联系邮箱：</label><input type="text" name="user[email]" value="<?= $user['email'] ?>">
							<a href="/profile#email">修改安全邮箱</a> <span>关注我的人可见</span> </li>
						<li><label>QQ：</label><input type="text" name="profiles[qq]" value="<?= isset($profiles['qq'])?$profiles['qq']:'' ?>"></li>
						<li><label>MSN：</label><input type="text" name="profiles[msn]" value="<?= isset($profiles['msn'])?$profiles['msn']:'' ?>"></li>
						<li><label>一句话介绍：</label><textarea name="profiles[一句话介绍]" rows="5"><?= isset($profiles['一句话介绍'])?$profiles['一句话介绍']:'' ?></textarea></li>
					</ul>
				</div>
				<div id="education" class="main tab-pane fade">
					<div class="warning">
						<p>以填写教育信息将会显示在你的个人资料页，还能帮助企业及会员在微博上快速了解彼此，注*为必填项</p>
					</div>

					<ul>
						<li><label>*所在地：</label>
							<select name="">
								<option>上海</option>
							</select>
							<select name="">
								<option>宝山区</option>
							</select>
						</li>
						<li><label>学校名称：</label>
							<input type="text" name="profiles[学校名称]" value="<?= isset($profiles['学校名称'])?$profiles['学校名称']:'' ?>" />
						</li>
						<li>
							<label>入学年份：</label>
							<input type="text" name="profiles[入学年份]" value="<?= isset($profiles['入学年份'])?$profiles['入学年份']:'' ?>">
						</li>
						<li><label>院系：</label><input type="text" name="profiles[院系]" value="<?= isset($profiles['院系'])?$profiles['院系']:'' ?>"></li>
					</ul>
				</div>
				<div id="career" class="main tab-pane fade">
					<div class="warning">
						<p>以下信息将显示在你的个人资料页，方便大家了解你，注*为必填项</p>
					</div>

					<ul>
						<li><label>* 所在地区：</label>
							<select>
								<option>上海市</option>
							</select>
							<select>
								<option>宝山区</option>
							</select>
							</span></li>
						<li><label>* 单位名称：</label><input type="text" name="workfor" value="<?= isset($profiles['单位名称'])?$profiles['单位名称']:'' ?>" /></li>
						<li><label>* 职位/部门：</label><input type="text"></li>
					</ul>
				</div>
				<div id="address" class="main tab-pane fade">
					<div class="warning">
						<p>如果你在智塔活动中获得了奖品或者获得奖金，我们将按照以下收货人信息发送奖品或者汇款到你指定的银行账
							户，所以请填写真实的收货信息，注*为必填项。</p>
					</div>

					<ul>
						<li><label>* 收货人姓名：</label><input type="text"></li>
						<li><label>* 证件类型：</label>
							<select>
								<option>请选择</option>
							</select>
						</li>
						<li><label>* 证件号码：</label><input type="text"></li>
						<li><label>* 银行账号：</label><input type="text"></li>
						<li><label>* 所在地区：</label>
							<select>
								<option>请选择</option>
							</select>
							<select>
								<option>请选择</option>
							</select>
							</span></li>
						<li><label>* 详细地址：</label><input type="text"></li>
						<li><label>* 邮政编码：</label><input type="text"></li>
						<li><label>* 联系电话：</label><input type="text"></li>
						<li><label>* 送货时间：</label>
							<select>
								<option>请选择</option>
							</select>
							</span></li>
					</ul>
				</div>
				<div id="password" class="main tab-pane fade">
					<div class="warning">
						<p>重要提示：每天互联网都会有大量用户的帐号存在</p>
					</div>
					<ul>
						<li><label>当前密码：</label><input type="password"></li>
						<li><label>新密码：</label><input type="password"></li>
						<li><label>安全强度：</label><span><img src="style/ps-grade.png"> 弱</span><span><img src="style/ps-grade-2.png"> 中</span><span><img src="style/ps-grade-3.png"> 强</span></li>
						<li><label>确认密码：</label><input type="password"></li>
					</ul>
				</div>
				<div id="email" class="main tab-pane fade">
					<div class="warning">
						<p>重要提示：设置安全邮箱，不用为密码丢失烦心了！</p>
					</div>
					<ol class="set-mail-step">
						<li class="on"><span>1</span>填写安全邮箱</li>
						<li><span>2</span>验证安全邮箱</li>
						<li><span>3</span>安全邮箱设置成功</li>
					</ol>
					<ul>
						<li><label>安全邮箱：</label><input type="password"></li>
						<li><label>微博登录密码：</label><input type="password"></li>
					</ul>
				</div>
				<ul class="buttons">
					<li><button type="submit" name="submit" class="btn btn-primary">保存</button></li>
				</ul>
			</div>
		</form>
	</div>
	<div id="right">
		<div class="box">
			<dl class="nav nav-tabs">
				<dt>帐号</dt>
				<dd><a href="#baseinfo" data-toggle="tab">基本信息</a></dd>
				<dd><a href="#education" data-toggle="tab">教育信息</a></dd>
				<dd><a href="#career" data-toggle="tab">职业信息</a></dd>
				<dd><a href="#tags" data-toggle="tab">个人标签</a></dd>
				<dd><a href="#address" data-toggle="tab">收货地址</a></dd>
				<dd class="active"><a href="#avartar" data-toggle="tab">修改头像</a></dd>
			</dl>
			<dl class="nav nav-tabs">
				<dt>帐号安全</dt>
				<dd><a href="#password" data-toggle="tab">修改密码</a></dd>
				<dd><a href="#email" data-toggle="tab">安全邮箱</a></dd>
			</dl>
		</div>
	</div>
</div>
<?
$this->view('footer')?>