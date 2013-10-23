<?$this->view('header')?>
<?if(isset($recommended_voting_project)){?>
	<div class="model recommend">
		<div class="title"><h3>每日热门投票</h3></div>
		<div class="main">
			<div class="info">
				<a href="/vote/<?=$recommended_voting_project['id']?>"><?=$this->image('project',$recommended_voting_project['id'],100)?></a>
				<a class="btn btn-primary pull-right" href="/vote/<?= $recommended_voting_project['id'] ?>">我要投票</a>
				<ul>
					<li><b>发布企业：</b><?= $recommended_voting_project['company_name'] ?>
						<?followButton($recommended_voting_project['company'])?>
					</li>
					<li><b>项目名称：</b><a href="/vote/<?= $recommended_voting_project['id'] ?>"><?= $recommended_voting_project['name'] ?></a></li>
					<li><b>项目介绍：</b><?= $recommended_voting_project['summary'] ?></li>
					<li><b>当前人数：</b><?= count($recommended_voting_project['voters']) ?>人</li>
				</ul>
			</div>
			<div class="scroll-img">
				<div class="pull-left"><p>他们已经投票</p></div>
				<div class="pull-right">
					<ul id="mycarousel" class="jcarousel-skin-tango">
						<?foreach($recommended_voting_project['voters'] as $voter){?>
						<li><a href="/space/<?= $voter['id'] ?>"><?=$this->image('avatar',$voter['id'],'100','65')?><span><?= $voter['name'] ?></span></a></li>
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
								<li>当前投票数：<?= $candidate['votes'] ?>票</li>
								<li>投票时间：<?= $recommended_voting_project['vote_start'] ?> 至 <?= $recommended_voting_project['vote_end'] ?></li>
							</ul>
						</li>
						<?}?>
					</ul>
				</div>
				<div class="tail"><a href="#"><< 更多候选名单</a></div>
			</div>
		</div>
	</div>
<?}?>
	<div class="search">
		<div class="title">
			<b class="s14">投票统计</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			进行的投票：<b class="s18"><?= $active_projects ?></b>
			&nbsp;&nbsp;&nbsp;
			投票总数：<b class="s18"><?= $sum_votes ?></b>票
		</div>

		<!--<? $this->view('vote/search') ?>-->

	</div>

	<div class="model list">
		<div class="title">
			<h3>投票排行榜</h3>
		</div>
		<div class="main">

			<div class="model-d pull-left">
				<h4>最新投票</h4>
				<div class="content">

					<?foreach($voting_projects['latest'] as $project){?>
					<div class="box">
						<a href="/vote/<?= $project['id'] ?>"><?=$this->image('project',$project['id'],200)?></a>
						<ul>
							<li><b>项目名称：</b><?= $project['name'] ?></li>
							<li><b>项目介绍：</b><?= $project['summary'] ?></li>
							<li><b>发布企业：</b><?= $project['company_name'] ?></li>
							<li><b>项目金额：</b><?= $project['bonus'] ?></li>
							<li><b>投票时间：</b><?= $project['vote_start'] ?> 至 <?= $project['vote_end'] ?></li>
							<li class="last">
								<span class="tags">
									<b>标签：</b>
									<?foreach($project['tags'] as $tags){?>
									<a href="#"><?= $tags ?></a>
									<?}?>
								</span>
								<div class="join">
									<p><?=$project['votes']?>票/<?=$project['voters']?>人</p><a href="/vote/<?=$project['id']?>">我要投票</a>
								</div>
							</li>
						</ul>
					</div>
					<?}?>

				</div>
			</div>

			<div class="model-d pull-right">
				<h4>热门投票</h4>
				<div class="content">

					<?foreach($voting_projects['hot'] as $project){?>
					<div class="box">
						<a href="/vote/<?= $project['id'] ?>"><?=$this->image('project',$project['id'],200)?></a>
						<ul>
							<li><b>项目名称：</b><?= $project['name'] ?></li>
							<li><b>项目介绍：</b><?= $project['summary'] ?></li>
							<li><b>发布企业：</b><?= $project['company_name'] ?></li>
							<li><b>项目金额：</b><?= $project['bonus'] ?></li>
							<li><b>投票时间：</b><?= $project['vote_start'] ?> 至 <?= $project['vote_end'] ?></li>
							<li class="last">
								<span class="tags">
									<b>标签：</b>
									<?foreach($project['tags'] as $tags){?>
									<a href="#"><?= $tags ?></a>
									<?}?>
								</span>
								<div class="join">
									<p><?=$project['votes']?>票/<?=$project['voters']?>人</p><a href="/vote/<?=$project['id']?>">我要投票</a>
								</div>
							</li>
						</ul>
					</div>
					<?}?>

				</div>
			</div>
		</div>
	</div>
<?$this->view('footer')?>