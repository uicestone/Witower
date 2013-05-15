<div class="model recommend">
	<div class="title"><h3>每日推荐</h3></div>
	<div class="main">
		<div class="info">
			<a href="/project/view/<?=$recommended_project['id']?>"><img src="<?=$recommended_project[image_path]?><?=$recommend_project[image_name]?>"><!--<img src="style/default/pro_p1.jpg">--></a>
			<ul>
				<li><b>发布企业：</b><?=$recommended_project['name']?>
					<!--{if $recommend_project[follow]}-->
						<span class="add_attention">已关注</span>
					<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?=$recommended_project['id']?>">加关注</a>
					<!--{/if}-->
				</li>
				<li><b>项目名称：</b><a href="/project/view/<?=$recommended_project['id']?>"><?=$recommended_project['name']?></a></li>
				<li><b>项目介绍：</b><?=$recommended_project['summary']?></li>
				<li><b>项目金额：</b><?=$recommended_project['bonus']?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>截止日期：</b><?=$recommended_project['date_end']?></li>
				<li>标签：
					<span class="tags">
						<?foreach($recommended_project['labels'] as $labels){?>
								<a href="/list/search/tag/<?=$labels?>"><?=$labels?></a>
						<?}?>
					</span>
					<a class="btn-c" href="/project/view/<?=$recommended_project['id']?>">我要参与</a>
				</li>
			</ul>

		</div>
		<div class="scroll-img">
			<div class="fn-left"><p>他们正在讨论</p></div>
			<div class="fn-right">
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<?foreach($recommended_project['comments'] as $data){?>
						<li><a href="/user/space/<?=$data['id']?>"><img src="style/default/<?=$data['username']?>_60.jpg"><span><?=$data['content']?></span></a></li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
</div>
