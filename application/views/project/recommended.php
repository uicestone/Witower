<div class="model recommend">
	<div class="title"><h3>每日推荐</h3></div>
	<div class="main">
		<div class="info">
			<a href="/project/<?=$recommended_project['id']?>"><img src="uploads/images/project/<?=$recommended_project['id']?>_100.jpg"><!--<img src="style/pro_p1.jpg">--></a>
			<ul>
				<li><b>发布企业：</b><?=$recommended_project['company_name']?>
<?if($this->user->hasFollowed($recommended_project['company'])){?>
					<span class="add_attention">已关注</span>
<?}else{?>
					<a href="javascript:void(0);" class="add_attention" uid="<?=$recommended_project['company']?>">加关注</a>
<?}?>
				</li>
				<li><b>项目名称：</b><a href="/project/<?=$recommended_project['id']?>"><?=$recommended_project['name']?></a></li>
				<li><b>项目介绍：</b><?=$recommended_project['summary']?></li>
				<li><b>项目金额：</b><?=$recommended_project['bonus']?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>截止日期：</b><?=$recommended_project['date_end']?></li>
				<li>标签：
					<span class="tags">
						<?foreach($recommended_project['tags'] as $tags){?>
								<a href="/list/search/tag/<?=$tags?>"><?=$tags?></a>
						<?}?>
					</span>
					<a class="btn-c" href="/project/<?=$recommended_project['id']?>">我要参与</a>
				</li>
			</ul>

		</div>
		<div class="scroll-img">
			<div class="fn-left"><p>他们正在讨论</p></div>
			<div class="fn-right">
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<?foreach($recommended_project['comments'] as $data){?>
						<li><a href="/user/space/<?=$data['id']?>"><img src="uploads/images/avartar/<?=$data['user']?>_30.jpg"><span><?=$data['username']?></span></a></li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
</div>
