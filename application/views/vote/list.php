<? $this->view('header') ?>
<div id="content" class="page-vote">
	<div class="breadcrumb">
		投票
	</div>
	<div class="model recommend">
		<div class="title"><h3>每日热门投票</h3></div>
		<div class="main">
			<div class="info">
				<a href="/vote/<?=$recommended_voting_project['id']?>"><img src="/uploads/images/project/<?=$recommended_voting_project['id']?>_100.jpg"></a>
				<ul>
					<li><b>发布企业：</b><?= $recommended_voting_project['company_name'] ?>
						<!--{if $recommend_project[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="pl f3 add_attention" uid="<?= $recommended_voting_project['id'] ?>">加关注</a>
						<!--{/if}-->
					</li>
					<li><b>项目名称：</b><a href="{url projectvote-view-<?= $recommended_voting_project['id'] ?>}"><?= $recommended_voting_project['name'] ?></a></li>
					<li><b>项目介绍：</b><?= $recommended_voting_project['summary'] ?></li>
					<li><b>当前人数：</b><?= $recommended_voting_project['votes'] ?>人</li>
				</ul>
			</div>
			<div class="scroll-img">
				<div class="fn-left"><p>他们已经投票</p></div>
				<div class="fn-right">
					<ul id="mycarousel" class="jcarousel-skin-tango">
						<?foreach($recommended_voting_project['voters'] as $project){?>
						<li><a href="index.php?user-space-<?= $project['id'] ?>"><img src="uploads/images/avartar/<?=$project['id']?>_30.jpg"><span><?= $project['name'] ?></span></a></li>
						<?}?>
					</ul>
				</div>
			</div>
			<div class="statistics">
				<div class="main">
					<ul>
						<?foreach($recommended_voting_project['candidates'] as $candidate){?>
						<li><b><?= $candidate['percentage']*100 ?>%</b>的人投票给<span><a href="<?=$candidate['id']?>"><?=$candidate['name']?></a></span><br>
							<ul>
								<li>当前投票数：<?= $recommended_voting_project['votes'] ?>票</li>
								<li>投票时间：<?= $recommended_voting_project['vote_start'] ?> 至 <?= $recommended_voting_project['vote_end'] ?></li>
							</ul>
							<a class="btn-a" href="/vote/<?= $recommended_voting_project['id'] ?>">我要投票</a>
						</li>
						<?}?>
					</ul>
				</div>
				<div class="tail"><a href="#"><< 更多候选名单</a></div>
			</div>
		</div>
	</div>
	<div class="search">
		<div class="title">
			<b class="s14">投票统计</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			进行的投票：<b class="s18"><?= $active_projects ?></b>
			&nbsp;&nbsp;&nbsp;
			投票总数：<b class="s18"><?= $sum_votes ?></b>票
		</div>

		<? $this->view('vote/search') ?>

	</div>

	<div class="model list">
		<div class="title">
			<h3>
				热门投票
				最新投票
				投票进行时
			</h3>
		</div>
		<div class="main">

			<div class="model-d fn-left">
				<h4>最新投票</h4>
				<div class="content">

					<?foreach($voting_projects['latest'] as $project){?>
					<div class="box">
						<a href="/project/<?= $project['id'] ?>}"><img src="/uploads/images/project/<?=$project['id']?>_200.jpg"></a>
						<ul>
							<li><b>项目名称：</b><?= $project['name'] ?></li>
							<li><b>项目介绍：</b><?= $project['summary'] ?></li>
							<li><b>发布企业：</b><?= $project['company_name'] ?></li>
							<li><b>项目金额：</b><?= $project['bonus'] ?></li>
							<li><b>投票时间：</b><?= $project['vote_start'] ?> 至 <?= $project['vote_end'] ?></li>
							<li class="tags">
								<b>标签：</b>
								<?foreach($project['tags'] as $tags){?>
								<a href="#"><?= $tags ?></a>
								<?}?>
							</li>
						</ul>
						<div class="join">
							<p><?=$project['votes']?>票/<?=$project['voters']?>人</p><a href="/vote/<?=$project['id']?>">我要投票</a>
						</div>
					</div>
					<?}?>

				</div>
			</div>

			<div class="model-d fn-right">
				<h4>热门投票</h4>
				<div class="content">

					<?foreach($voting_projects['hot'] as $project){?>
					<div class="box">
						<a href="{url projectvote-view-<?= $project['id'] ?>}"><img src="uploads/images/project/<?=$project['id']?>_200.jpg"></a>
						<ul>
							<li><b>项目名称：</b><?= $project['name'] ?></li>
							<li><b>项目介绍：</b><?= $project['summary'] ?></li>
							<li><b>发布企业：</b><?= $project['company_name'] ?></li>
							<li><b>项目金额：</b><?= $project['bonus'] ?></li>
							<li><b>投票时间：</b><?= $project['vote_start'] ?> 至 <?= $project['vote_end'] ?></li>
							<li class="tags">
								<b>标签：</b>
								<?foreach($project['tags'] as $tags){?>
								<a href="#"><?= $tags ?></a>
								<?}?>
							</li>
						</ul>
						<div class="join">
							<p><?=$project['votes']?>票/<?=$project['voters']?>人</p><a href="/vote/<?=$project['id']?>">我要投票</a>
						</div>
					</div>
					<?}?>

				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>