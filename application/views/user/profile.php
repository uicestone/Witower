<?$this->view('header')?>
<div id="content" class="model-view page-home">
	<div class="breadcrumb">
		<strong><a href="#">当前位置</a></strong><span>&nbsp;&gt;&nbsp;<a href="#">修改头像</a></span>
	</div>
	<div id="left">
		<div class="model model-b">
			<form method="post" enctype="multipart/form-data">
<!--{if $page=='avartar'}-->
			<div class="main">
				<div class="warning">
					<p>注：仅支持JPG、GIF、PNG图片文件，且文件小于5M</p>
				</div>
				<div>
					<div class="model-lr model-uploadPhoto">
						<div class="fn-left">
							<input type="file" name="avatar">
							<input type="submit" name="upload_avatar" value="上传">
						</div>
						<div class="fn-right">
							<p>您上传的头像会自动生成三种尺寸，请注意中小尺寸
								的头像是否清晰。</p>
							<img src="style/default/edit-photo.jpg">
						</div>
					</div>
				</div>
			</div>
<!--{elseif !$page || $page=='baseinfo'}-->
			<div class="main">
				<div class="warning">
					以下信息将显示在个人资料页，方便大家了解你，注*为必填项
				</div>
			<ul>
				<li><label>*昵称：</label><input type="text" name="username" value="<?=$username?>"></li>
				<li><label>真实姓名：</label><input type="text" name="truename" value="<?=$truename?>"><span>仅自己可见</span></li>
				<li><label>*所在地：</label>
					<select name="location0">
						<option>上海</option>
					</select>
					<select name="location1">
						<option>宝山区</option>
					</select>
				</li>
				<li><label>*性别：</label><input type="radio" name="gender" value="男" {if  $gender=='男'}checked="checked"<!--{/if}-->>男  <input type="radio" name="gender" value="女" {if  $gender=='女'}checked="checked"<!--{/if}-->>女</li>
				<li><label>联系邮箱：</label><input type="text" name="email" value="<?=$email?>">
					<a href="/?user-profile-email">修改安全邮箱</a> <span>关注我的人可见</span> </li>
				<li><label>QQ：</label><input type="text" name="qq" value="<?=$qq?>"></li>
				<li><label>MSN：</label><input type="text" name="msn" value="<?=$msn?>"></li>
				<li><label>一句话介绍：</label><textarea name="intro" rows="5"><?=$intro?></textarea></li>
			</ul>
				<ul class="buttons">
					<li><button type="submit" name="update" value="1" class="btn-c">提交</button></li>
				</ul>
			</div>
<!--{elseif $page=='education'}-->
			<div class="main">
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
					<li><label>学校名称：</label><input type="text" name="school" value="<?=$school?>" />
			<span><label>入学年份</label>
			<select name="year_enter">
				<?=$year_enter_options?>
			</select></span></li>
					<li><label>院系：</label><input type="text" name="subschool" value="<?=$subschool?>"></li>
				</ul>
				<ul class="buttons">
					<li><button type="submit" name="update" value="1" class="btn-c">保存</button></li>
				</ul>
			</div>
<!--{elseif $page=='career'}-->
			<div class="main">
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
						<li><label>* 单位名称：</label><input type="text" name="workfor" value="<?=$workfor?>" /></li>
						<!--<li><label>* 工作时间：</label>
							<select>
								<option>请选择</option>
							</select>
							<select>
								<option>请选择</option>
							</select>
							</span></li>-->
						<li><label>* 职位/部门：</label><input type="text"></li>
					</ul>
				<ul class="buttons">
					<li><button class="btn-c">保存</button><button class="btn-c" type="reset">重置</button></li>
				</ul>
			</div>
<!--{elseif $page=='tags'}-->
			<div class="main">
				<div class="warning">
					<p>添加描述自己职业、兴趣爱好等方面的词语，让更多人找到你，让你找到更多同类。</p>
				</div>
				<div>
				<div class="model-lr">
				   <div class="fn-left">
					   <input type="text">
					   <input type="button" value="添加">
				   </div>
				   <div class="fn-right">
					   <p>已添加标签A(7个)</p>
					   <ul>
						   <li><span>+</span>听歌</li>
						   <li><span>+</span>上网</li>
						   <li><span>+</span>听歌</li>
						   <li><span>+</span>上网</li>
						   <li><span>+</span>听歌</li>
						   <li><span>+</span>上网</li>
						   <li><span>+</span>听歌</li>
						   <li><span>+</span>上网</li>
						   <li><span>+</span>听歌</li>
						   <li><span>+</span>上网</li>
					   </ul>
				   </div>
				</div>
					<div class="hr"></div>
					<div>
						<dl>
							<dt>关于标签：</dt>
							<dd>标签是自定义描述自己职业、兴趣爱好的关键词，让更多人找到你，让你找到更多同类。</dd>
							<dd>已经添加的标签将显示在“我的微博”页面右侧栏中，方便大家了解你。</dd>
							<dd>在此查看你自己添加的所有标签，还可以方便地管理，最多可添加10个标签。 </dd>
							<dd>点击你已添加的标签，可以搜索到有同样兴趣的人。</dd>
						</dl>
					</div>
				</div>
			</div>
<!--{elseif $page=='address'}-->
			<div class="main">
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
				<ul class="buttons">
					<li><button class="btn-c">保存</button><button class="btn-c" type="reset">重置</button></li>
				</ul>
			</div>
<!--{elseif $page=='blacklist'}-->
			<div class="main">
				<div class="warning">
					<p>被加入黑名单的用户将无法关注你、评论你。如果你已经关注他，也会自动解除关系。</p>
				</div>
				<div class="black-list">
				 <ul>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
					 <li><a href="#" class="fn-left">失去自我的世界</a><span class="fn-right">2012-12-18 10：59<button>移除</button></span></li>
				 </ul>
				</div>
			</div>
<!--{elseif $page=='personal'}-->
			<div class="main">
			   <div class="warning">
					<p>以下是提示消息的设置。</p>
				</div>
				<div>
					<div class="personal-setting">
						<div>
							<h3><span> 微博小黄签</span>设置哪些新消息，设置微博小黄签提醒我</h3>
							<ul>
								<li><input type="checkbox"><div>新评论提醒</div></li>
								<li><input type="checkbox"><div>新粉丝提醒</div></li>
								<li><input type="checkbox"><div>新私信提醒</div></li>
								<li><input type="checkbox"><div>@到我提醒
									<div>设置哪些@提到我的微博/评论计入@提醒数字中
										<span>微博的类型是：<input type="radio">所有微博<input type="radio">原创微博</span>
									</div>
								</div></li>
								<li><input type="checkbox"><div>群内新消息提醒</div></li>
								<li><input type="checkbox"><div>相册新消息提醒</div></li>
								<li><input type="checkbox"><div>新通知提醒</div></li>
								<li><input type="checkbox"><div>新邀请提醒</div></li>
							</ul>
						</div>
						<div>
							<h3><span> 聊天</span>设置一对一私聊模式</h3>
							<ul>
								<li><input type="checkbox"><div>开户即时聊天对话模式（可在我的首页中与互粉好友一对一即时聊天）</div></li>
							</ul>
						</div>
						<div>
							<h3><span> 在线状态</span>设置是否别人能够看到自己的在线状态</h3>
							<ul>
								<li><input type="checkbox"><div>允许</div></li>
							</ul>
						</div>
						<div>
							<h3><span> 图片水印</span>设置在图片微博中增加独具个性的微博水印</h3>
							<ul>
								<li>水印样式：</li>
								<li><input type="checkbox"><div>微博昵称</div></li>
								<li><input type="checkbox"><div>微博图标</div></li>
								<li><input type="checkbox"><div>微博地址</div></li>
								<li></li>
								<li>水印位置</li>
								<li><input type="radio">底部居右<input type="radio">底部居中<input type="radio">底部居左</li>
							</ul>
						</div>
						<div>
							<h3><span> 邮件</span>设置是否接受微博邮件提示服务</h3>
							<ul>
								<li><input type="checkbox"><div>接收来自微博的邮件（较长时间不登录时，自动获取新浪微博的提示信息）</div></li>
							</ul>
						</div>
						<ul class="buttons">
							<li><button class="btn-c">保存</button><button class="btn-c" type="reset">重置</button></li>
						</ul>
					</div>
				</div>
			</div>
<!--{elseif $page=='safety'}-->
			<div class="main page-safety">
				<table>
					<tr>
						<td>帐号安全系数：</td>
						<td>3<span class="progress-bar"><span></span></span><p>上次登录：<span>>2012年12月9日（上海）</span></p></td>
						<td></td>
					</tr>
					<tr>
						<td>密码：</td>
						<td>当前密码安全度<span class="progress-bar"><span></span></span><p>建议密码由8位以上数字、字母和特殊字符组成。</p></td>
						<td><a href="#" class="edit">修改</a></td>
					</tr>
					<tr>
						<td>安全邮箱：</td>
						<td>8786@qq.com</span></span><p>忘记密码时，您的绑定邮箱可以帮您找回密码。</p></td>
						<td><a href="#" class="edit">修改</a></td>
					</tr>
					<tr>
						<td>安全提醒：</td>
						<td>尚未设置安全提醒</span></span><p>使用电子邮件</p></td>
						<td><a href="#" class="edit">修改</a></td>
					</tr>
				</table>
				<ul class="buttons">
					<li><button class="btn-c">保存</button></li>
				</ul>
			</div>
<!--{elseif $page=='password'}-->
			<div class="main">
				<div class="warning">
					<p>重要提示：每天互联网都会有大量用户的帐号存在</p>
				</div>
				<ul>
					<li><label>当前密码：</label><input type="password"></li>
					<li><label>新密码：</label><input type="password"></li>
					<li><label>安全强度：</label><span><img src="style/default/ps-grade.png"> 弱</span><span><img src="style/default/ps-grade-2.png"> 中</span><span><img src="style/default/ps-grade-3.png"> 强</span></li>
					<li><label>确认密码：</label><input type="password"></li>
				</ul>
				<ul class="buttons">
					<li><button class="btn-c">保存</button><button class="btn-c" type="reset">重置</button></li>
				</ul>
			</div>
<!--{elseif $page=='email'}-->
			<div class="main">
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
				<ul class="buttons">
					<li><button class="btn-c">保存</button><button class="btn-c" type="reset">重置</button></li>
				</ul>
			</div>
<!--{elseif $page=='safetynotice'}-->
			<div class="main">
				<table class="safety_notice table table-bordered">
					<thead>
					<tr><td>消息提醒内容</td><td>消息提醒内容</td><td>消息提醒内容</td><td>消息提醒内容</td></tr>
					</thead>
					<tbody>
					<tr>
						<td>修改密码</td><td><input type="radio"></td><td><input type="radio"></td><td><input type="radio"></td>
					</tr>
					<tr>
						<td>修改登录保护</td><td><input type="radio"></td><td><input type="radio"></td><td><input type="radio"></td>
					</tr>
					<tr>
						<td>异地登录</td><td><input type="radio"></td><td><input type="radio"></td><td><input type="radio"></td>
					</tr>
					</tbody>
				</table>
				<ul class="buttons">
					<li><button class="btn-c">保存</button></li>
				</ul>
			</div>
<!--{/if}-->
		</div>
	</div>
	<div id="right">
		<div class="box">
			<dl>
				<dt>帐号</dt>
				<dd><a href="/?user-profile-baseinfo">基本信息</a></dd>
				<dd><a href="/?user-profile-education">教育信息</a></dd>
				<dd><a href="/?user-profile-career">职业信息</a></dd>
				<dd><a href="/?user-profile-tags">个人标签</a></dd>
				<dd><a href="/?user-profile-address">收货地址</a></dd>
				<dd><a href="/?user-profile-avartar">修改头像</a></dd>
				<dd><a href="/?user-profile-blacklist">黑名单</a></dd>
				<dd><a href="/?user-profile-personal">个性设置</a></dd>
			</dl>
			<dl>
				<dt>帐号安全</dt>
				<dd><a href="/?user-profile-safety">安全信息</a></dd>
				<dd><a href="/?user-profile-password">修改密码</a></dd>
				<dd><a href="/?user-profile-email">安全邮箱</a></dd>
				<dd><a href="/?user-profile-safetynotice">安全提醒</a></dd>
			</dl>
		</div>
	</div>
</div>
<?$this->view('footer')?>