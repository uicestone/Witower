<div class="model recommend">
	<div class="title"><h3>每日推荐</h3></div>
	<div class="main">
		<div class="info">
			<a href="/project/<?=$recommended_project['id']?>"><?=$this->image('project',$recommended_project['id'],100)?></a>
			<a class="btn btn-primary pull-right" href="/project/<?=$recommended_project['id']?>">我要参与</a>
			<ul>
				<li><b>发布企业：</b><?=$recommended_project['company_name']?>
					<?followButton($recommended_project['company'])?>
				</li>
				<li><b>项目名称：</b><a href="/project/<?=$recommended_project['id']?>"><?=$recommended_project['name']?></a></li>
				<li><b>项目介绍：</b><?=$recommended_project['summary']?></li>
				<li><b>项目金额：</b><?=$recommended_project['bonus']?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>截止日期：</b><?=$recommended_project['wit_end']?></li>
				<li>标签：
					<span class="tags">
						<?foreach($recommended_project['tags'] as $tags){?>
								<a href="/list/search/tag/<?=$tags?>"><?=$tags?></a>
						<?}?>
					</span>
				</li>
			</ul>

		</div>
		<div class="scroll-img">
			<div class="pull-left"><p>他们正在讨论</p></div>
			<div class="pull-right">
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<?foreach($recommended_project['comments'] as $comment){?>
						<li><a href="/user/space/<?=$comment['user']?>"><?=$this->image('avatar',$comment['user'],100,65)?><span><?=$comment['username']?></span></a></li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
</div>
