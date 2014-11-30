<? $this->view('header')?>
<?if(isset($recommended_voting_project)){?>
	<div class="model recommend">
		<div class="main">
			<!--<div class="info">
				<a href="/vote/<?=$recommended_voting_project['id']?>"><?=$this->image('project',$recommended_voting_project['id'],100)?></a>
				<a class="btn btn-primary pull-right" href="/vote/<?= $recommended_voting_project['id'] ?>">我要投票</a>
				<ul>
					<li><b>发布企业：</b><?= $recommended_voting_project['company_name'] ?>
						<?followButton($recommended_voting_project['company'])?>
					</li>
					<li><b>项目名称：</b><a href="/vote/<?= $recommended_voting_project['id'] ?>"><?= $recommended_voting_project['name'] ?></a></li>
					<li>
						<div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div></div>
						<script>window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
					</li> 
					<li>
						<div class="clearfix"><h4>项目描述：</h4></div>
						<div class="well"><?= $recommended_voting_project['summary'] ?></div>
					</li>
					<li><h4>当前投票<?= count($recommended_voting_project['voters']) ?>人</h4></li>
				</ul>
			</div>-->
			<div class="maxred" style="height:430px">
		<div class="img"><?=$this->image('project',$recommended_voting_project['id'])?></div>
		<div class="reday_r">
			<h2><strong><a href="/vote/<?= $recommended_voting_project['id'] ?>"><?= $recommended_voting_project['name'] ?></a>(热门投票)</strong></h2>
			<h4>项目描述</h4><?= $recommended_voting_project['summary'] ?>
			<strong>发布企业：<?= $recommended_voting_project['company_name'] ?>
						<?followButton($recommended_voting_project['company'])?></strong>
			<br><strong>活动状态：<?= lang($recommended_voting_project['status']) ?></strong>
			<br><strong>项目金额：<span><?= $recommended_voting_project['bonus'] ?></span>元<br></strong>
			<strong>截止时间：<?= $recommended_voting_project['wit_end'] ?>
			&nbsp;</strong>
			<br><strong>标签：
			<? foreach ($recommended_voting_project['tags'] as $tag) { ?>
			<a href="#"><?= $tag ?></a></strong>
			<? } ?><div class=""><div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div></div>
			<script>window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};
			with (document)
			0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
		</div>
	</div>
			<div class="scroll-img" style="bottom: 79px;background: none repeat scroll 0 0 #fff;height: 25px;line-height: 25px;position: absolute;text-align: center;width: 110px;" ><strong>当前参与人员</strong></div>
			<div class="blocks" >
			<div class="list1" style="width:1000px;">
			<div class="left"><img src="<?=site_url()?>style/left.png" /></div>
			<div class="maxul">
				<ul>
				<?foreach($recommended_voting_project['voters'] as $voter){?>
				<li><a href="/space/<?=$voter['id']?>">
				  <?=$this->image('avatar',$voter['id'],100,55)?>
				  <span>
				  <?=$voter['name']?>
				  </span></a></li>
				<?}?>
				</ul>
			</div>
			<div class="right"><img src="<?=site_url()?>style/right.png" /></div>
			</div>
			</div>
				<!--<div class="pull-right">
					<ul id="mycarousel" class="jcarousel-skin-tango">
						<?foreach($recommended_voting_project['voters'] as $voter){?>
						<li><a href="/space/<?= $voter['id'] ?>"><?=$this->image('avatar',$voter['id'],'100','65')?><span><?= $voter['name'] ?></span></a></li>
						<?}?>
					</ul>
				</div>-->
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
			</div>
		</div>
	</div>
<?}?>
	<!--<div class="search">
		<div class="title">
			<b class="s14">投票统计</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b class="s18"><?= $active_projects ?>个正在进行的投票</b>
			&nbsp;&nbsp;&nbsp;
			<b class="s18">共计投<?= $sum_votes ?></b>票
		</div>

		<? $this->view('vote/search') ?>

	</div>-->

	<div class="model list">
		<div class="title">
			<h3>投票排行榜</h3>
			<b class="s18">（有<?= $active_projects ?>个项目正在进行投票，共计投<?= $sum_votes ?></b>票）
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