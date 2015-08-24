<?php $this->view('header'); ?>
<link href="<?=base_url()?>style/xiangmutoupiao1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>style/index.css" rel="stylesheet" type="text/css" />
<?php if(isset($recommended_voting_project)){ ?>
<div class="indexDiv">
    <div class="heading"><a href="<?=site_url()?>/vote/<?= $recommended_voting_project['id'] ?>"><?= $recommended_voting_project['name'] ?></div>
    <img src="<?=base_url()?>uploads/images/project/<?=$recommended_voting_project['id']?>.jpg" width="100%"/>
    <div class="content">
        <div class="section">项目描述 : <span><?= $recommended_voting_project['summary'] ?></span></div>

        <div class="section1">企业名称 : <span><?= $recommended_voting_project['company_name'] ?>
    		<?php followButton($recommended_voting_project['company']) ?></span>

        </div>
        <div class="section">活动状态 : <span><?= lang($recommended_voting_project['status']) ?></span></div>
        <div class="section">项目金额 : <span id="i"><span><?= $recommended_voting_project['bonus'] ?>元</span></div>
        <div class="section">截止时间 : <span class="ii"><?= $recommended_voting_project['wit_end'] ?></span></div>

    <?php foreach ($recommended_voting_project['tags'] as $tag) { ?>
			<a href="#"><?= $tag ?></a>
	<?php } ?>
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

    <div class="hx"></div>

    <div class="heading1">候选人名单及投票</div>
        <div class="hx"></div>
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
    </div>
<?php } ?>
    <div class="hx2"></div>

		<?php foreach($recommended_voting_project['candidates'] as $candidate){ ?>
			<h4><span style="color:red"><?= $candidate['percentage']*100 ?>%</span>投票给<a href="<?=$candidate['id']?>"><?=$candidate['name']?></a></h4>
                    <li>当前投票数：<?= $candidate['votes'] ?>票
					投票时间：<?= $recommended_voting_project['vote_start'] ?> 至 <?= $recommended_voting_project['vote_end'] ?></li>
					<div class="hx2"></div>
			<?php } ?>
			<?php $this->view('vote/search'); ?>
	<div class="hx2"></div>
	<div >
	 	<?php foreach ($projects as $project) { ?>
	      <li>
	          <div class="imgDiv"><a href="<?= site_url() ?>vote/<?= $project['id'] ?>"><img src="<?=base_url()?>uploads/images/project/<?=$project['id']?>.jpg" height="87px"/></a></div>
	          <div class="bg">
	              <div class="name"><a href="<?= site_url() ?>vote/<?= $project['id'] ?>"><?= $project['name'] ?></div>
	              <div class="time">截止时间：<?= in_array($project['status'], array('preparing', 'witting')) ? $project['wit_end'] : $project['vote_end'] ?> <em><?= lang($project['status']) ?></em></div>
	              <div class="price"><a href="<?= site_url() ?>vote/<?= $project['id'] ?>">项目金额：<span><?= $project['bonus'] ?></span></div>
	              <div class="msg">讨论留言：<?= $project['comments_count'] ?><span>参与人数：<?= $project['witters'] ?></span></div>
	          </div>
	      </li>

	      <?}?>
	</div>


</div>


<?php $this->view('footer'); ?>