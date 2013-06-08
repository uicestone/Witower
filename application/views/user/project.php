<?$this->view('header')?>
<div id="content" class="page-company">
	<div class="breadcrumb">
		<strong>用户</strong><span>&nbsp;&gt;&nbsp;<!--{if $function=='home'}-->我的主页<!--{elseif $function=='space'}--><?=$userinfo[username]?><!--{/if}--></span>
	</div>
	<div id="left" class="sidebar">
		<div class="box menu">
			 <ul class="nav nav-list">
		<li{if $mode=='product'} class="active"{/if}><a href="/?user-projectlist-product">产品管理</a></li>
				<li{if $mode=='project'} class="active"{/if}><a href="/?user-projectlist-project">项目管理</a></li>
<!--                <li><a href="#">作品管理</a></li>-->
<!--                <li><a href="#">财务管理</a></li>-->
<!--                <li><a href="#">用户资料</a></li>-->
				<li class="divider"></li>
			</ul>
		</div>
		<div class="box list">
			<ul class="nav nav-list">
				<li class="nav-header">寻求帮助</li>
				<li><a href="#">如何快速发布项目活动？</a></li>
				<li><a href="#">正等待你选出后选人</a></li>
				<li><a href="#">三星LEX3D手机创意作品</a></li>
				<li><a href="#">世联研究房价备案制</a></li>
				<li><a href="#">博策堂开发商正在面临</a></li>
				<li class="divider"></li>
			  </ul>
		</div>
		<div class="box list">
			<ul class="nav nav-list">
				<li class="nav-header">新手帮助</li>
				<li><a href="#">如何快速发布项目活动？</a></li>
				<li><a href="#">正等待你选出后选人</a></li>
				<li><a href="#">三星LEX3D手机创意作品</a></li>
				<li><a href="#">世联研究房价备案制</a></li>
				<li><a href="#">博策堂开发商正在面临</a></li>
				<li class="divider"></li>
			  </ul>
		</div>
	</div>
	<div id="right">
		<div class="model">
			<div class="title"><h3>{if $mode=='product'}产品管理{elseif $mode=='project'}项目管理{/if}</h3></div>
			<div class="main">
				<div class="tab">
<!--                    <ul class="nav nav-tabs">
					  <li><a href="#">新增产品</a></li>
					  <li><a href="#">新增项目</a></li>
					</ul>-->
				</div>
				<!--{if $mode == 'product'}-->
				<div class="show_content">
					<form>
						<button class="btn btn-info" type="button" onclick="location.href='/?user-editproduct'">增加新产品</button>
						<table class="table table-bordered">
							<thead>
							<tr> <td>编号</td><td>产品名称</td><td>图片</td><td class="descript">描述</td><td>操作</td><td>统计</td></tr>
							</thead>
							<tbody>
								<!--{loop $list $product}-->
							<tr> 
								<td><?=$product[no]?></td>
								<td><?=$product[name]?></td>
								<td><img src="/uploads/images/products/<?=$product[id]?>.jpg" width="80px"></td>
								<td><?=$product[intro]?></td>
								<td>
									<button class="btn btn-small" type="button" onclick="location.href='/?user-editproduct-<?=$product[id]?>'">修改</button><br>
									<button class="btn btn-small" type="button" onclick="window.open('/?user-createproject-<?=$product[id]?>')">发布项目</button>
								</td>
								<td>
									3个进行中的项目<br>
									6个投票中的项目<br>
									5个作品
								</td>
							</tr>
							<!--{/loop}-->


							</tbody>
						</table>
					</form>
				</div>
		<!--{/if}-->
		<!--{if $mode=='project'}-->
				<div class="show_content">
					<form>
<!--                        <button class="btn btn-info" type="button" onclick="location.href='/?user-editproject'">增加新项目</button>-->
						<table class="table table-bordered">
							<thead>
							<tr> <td>编号</td><td>项目名称</td>
								<td>所属产品</td>
								<td>图片</td><td style="width: 70px;">描述</td><td style="width:100px;">时间</td><td>操作</td><!--<td>统计</td>--></tr>
							</thead>
							<tbody>
			<!--{loop $list $project}-->
							<tr>
							 <td><?=$project[p_id]?></td>
							 <td><?=$project[title]?></td>
							 <td><?=$project[product_name]?></td>
							 <td><img src="/uploads/images/projects/<?=$project[p_id]?>.jpg" width="80px"></td>
							 <td><?=$project[summary]?></td>
								<td>发布：<br><?=$project[start_time]?><br>截止：<br><?=$project[end_time]?></td>
								<td><button class="btn btn-small" type="button" >查看</button><br>
									<button class="btn btn-small" type="button" >修改</button><br></td>
									6个投票中的项目
								</td>-->
							</tr>
							<!--{/loop}-->
							</tbody>
						</table>
					</form>
				</div>
<!--{/if}-->
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>