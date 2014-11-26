<?php $this->view('header'); ?>

<?php if(isset($recommended_project)){ ?>
<?php $this->view('project/recommended'); ?>
<?php } ?>
<br>
<div class="search">
<?php $this->view('project/search'); ?>
</div>

<div style="width:980px; overflow:hidden; margin:0 auto;">
	<div id="content" class="wrapper<? if ($this->page_name) { ?> page-<?= $this->page_name ?><? } ?>">
		<div class="water hide">
			<?php foreach ($projects as $project) { ?>
			<div class="box" style="background:#f2f2f2;">
				<div class="img cell">
					<a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
						<?= $this->image('project', $project['id'], 200) ?>
					</a>
					<h4><?= $project['name'] ?></h4>
					<div class="blockd"><font class="fonts">截止时间：<?= in_array($project['status'], array('preparing', 'witting')) ? $project['wit_end'] : $project['vote_end'] ?></font><span><?= lang($project['status']) ?></span></div>
				</div>



				<div class="details cell">
					<ul class="list">
						<li><a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
								<span><?= $project['comments_count'] ?></span>
								<p>讨论留言</p>
							</a>
						</li>
						<li><a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
								<span style="font-family:微软雅黑;">￥<?= $project['bonus'] ?></span>
								<p>项目金额</p>
							</a>
						</li>
						<li><a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
								<span><?= $project['witters'] ?></span>
								<p>参与人数</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php $this->view('footer'); ?>
