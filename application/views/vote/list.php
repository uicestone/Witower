<?php $this->view('header'); ?>
<?php if(isset($recommended_voting_project)){ ?>
<div style="width:1000px; overflow:hidden; margin:15px auto;background:#fff;border-radius: 5px;">
	<div class="maxred" style="height:430px">
		<div class="img"><?= $this->image('project', $recommended_voting_project['id']) ?></div>
		<div class="reday_r">
			<h2><strong><a href="/vote/<?= $recommended_voting_project['id'] ?>"><?= $recommended_voting_project['name'] ?></a>(热门投票)</strong></h2>
			<h4>项目描述</h4><?= $recommended_voting_project['summary'] ?>
			<strong>发布企业：<?= $recommended_voting_project['company_name'] ?>
				<?php followButton($recommended_voting_project['company']) ?></strong>
			<br><strong>活动状态：<?= lang($recommended_voting_project['status']) ?></strong>
			<br><strong>项目金额：<span><?= $recommended_voting_project['bonus'] ?></span>元<br></strong>
			<strong>截止时间：<?= $recommended_voting_project['wit_end'] ?>
				&nbsp;</strong>
			<br>
			<strong>标签：</strong>
			<?php foreach ($recommended_voting_project['tags'] as $tag) { ?>
			<a href="#"><?= $tag ?></a>
			<?php } ?>
			<div class="">
				<div class="bdsharebuttonbox">
					<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
					<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
					<a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
					<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
					<a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a>
					<a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
					<a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a>
					<a href="#" class="bds_more" data-cmd="more"></a>
				</div>
			</div>
			<script type="text/javascript">
				window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};
				with (document)
				0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
			</script>
		</div>
	</div>
	<div class="scroll-img" style="bottom: 79px;background: none repeat scroll 0 0 #fff;height: 22px;line-height: 25px;position: absolute;text-align: center;width: 110px;" ><strong>当前参与人员</strong></div>
	<div class="blocks">
		<div class="list1" style="width:1000px;">
			<div class="left"><img src="<?= site_url() ?>style/left.png" /></div>
			<div class="maxul">
				<ul>
					<?php foreach ($recommended_voting_project['voters'] as $voter) { ?>
					<li>
						<a href="/space/<?= $voter['id'] ?>">
							<?= $this->image('avatar', $voter['id'], 100, 55) ?>
							<span>
								<?= $voter['name'] ?>
							</span>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="right"><img src="<?= site_url() ?>style/right.png" /></div>
		</div>
	</div>
</div>
<div  style="width:1000px; overflow:hidden; margin:15px auto;background:#fff;border-radius: 5px;">
	<div style="margin:15px;line-height:10px;">
		<ul><h5>
			<?php foreach($recommended_voting_project['candidates'] as $candidate){ ?>
			<b><h4><span style="color:red"><?= $candidate['percentage']*100 ?>%</span>投票给<a href="<?=$candidate['id']?>"><?=$candidate['name']?></a></h4>

					<li>当前投票数：<?= $candidate['votes'] ?>票
					投票时间：<?= $recommended_voting_project['vote_start'] ?> 至 <?= $recommended_voting_project['vote_end'] ?></li>
			<?php } ?>
		</h5></ul>
	</div>
</div>
<?php } ?>
<div class="search">
	<div class="main">
		<h4><b>投票统计</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>有<?= $active_projects ?>个正在进行的投票</b>
			&nbsp;&nbsp;&nbsp;
			<b>共计投<?= $sum_votes ?></b>票</h4>
	</div>
	<?php $this->view('vote/search'); ?>
</div>
<div style="width:980px; overflow:hidden; margin:15px auto;">
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