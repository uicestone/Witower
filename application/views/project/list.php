<?$this->view('header')?>
<div id="content" class="page-list">
	<?$this->view('project/recommended')?>

	<div class="search">
		<div class="title">
			<b class="s14">项目统计</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			进行的项目：<b class="s18"><?=$active_projects?></b>
			&nbsp;&nbsp;&nbsp;
			参与的人数：<b class="s18"><?=$witters?></b>人
		</div>

		<!--<?$this->view('project/search')?>-->

	</div>

	<div class="model">
		<div class="title">
			<h3>项目排行榜</h3>
		</div>
		<div class="main">
			<div class="model-a">
				<h4>最新项目</h4>

				<?foreach($projects['latest'] as $project){?>
				<div class="main">
                                    <a href="/project/<?=$project['id']?>"><?=$this->image('project',$project['id'],200)?></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['wit_start']?> 至 <?=$project['wit_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['tags'] as $tags){?>
								<a href="<?=$tags?>"><?=$tags?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['witters']?>)</a></li>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li><span class="icon-heart"></span><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			<div class="model-a">
				<h4>人气项目</h4>

				<?foreach($projects['hot'] as $project){?>
				<div class="main">
					<a href="/project/<?=$project['id']?>"><?=$this->image('project',$project['id'],200)?></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['wit_start']?> 至 <?=$project['wit_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['tags'] as $tags){?>
								<a href="<?=$tags?>"><?=$tags?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['witters']?>)</a></li>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li><span class="icon-heart"></span><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			<div class="model-a">
				<h4>项目金额</h4>

				<?foreach($projects['high_bonus'] as $project){?>
				<div class="main">
					<a href="/project/<?=$project['id']?>"><?=$this->image('project',$project['id'],200)?></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['wit_start']?> 至 <?=$project['wit_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['tags'] as $tags){?>
								<a href="<?=$tags?>"><?=$tags?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['witters']?>)</a></li>
						<li><span class="icon-comment"></span><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li><span class="icon-heart"></span><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			</div>
	</div>
</div>
<?$this->view('footer')?>
