<?php $this->view('header'); ?>
<!--
<div class="span12">
	<div class="model model-b">
<?php $this->view('alert'); ?>
		<div class="main">
<?php if ($this->user->id === $piece['user'] || $this->user->isLogged(array('witower', 'piece'))) { ?>
				<a href="<?= site_url() ?>piece/edit/<?= $piece['id'] ?>" class="btn pull-right">编辑</a>
<?php } ?>
			<h3><?= $piece['name'] ?></h3>
			<div class="info">
				<div>
					<p><?= $piece['description'] ?></p>
				</div>
			</div>
		</div>
	</div>
<? foreach ($piece['files'] as $file) { ?>
		<div class="model model-b">
			<div class="main">
	<?php if (preg_match('/^image/', $file->file_type)) { ?>
					<img src="<?= $file->url ?>">
	<?php } elseif (preg_match('/^video/', $file->file_type)) { ?>
					<video src="<?= $file->url ?>">
	<?php } ?>
			</div>
		</div>
<? } ?>
<?php if ($this->user->isLogged(array('witower', 'piece'))) { ?>
		<form class="form-inline" method="post">
			<input type="text" name="amount" placeholder="积分数量">
			<button type="submit" name="award" class="btn">奖励积分给上传者</button>
		</form>
<?php } ?>
</div>
-->
<div class="contentmax">
	<div class="dh"><h2>当前位置：</h2><a href="<?= site_url() ?>">首页</a> / <a href="<?= site_url() ?>piece">作品</a> / <a href="#"> 产品详细</a></div>
	<div class="detail">
		<div class="recon">
			<div style="margin-left: 2px;">
				<div class="model model-b">
					<?php $this->view('alert'); ?>
					<div class="main">
						<?php if ($this->user->id === $piece['user'] || $this->user->isLogged(array('witower', 'piece'))) { ?>
							<a href="<?= site_url() ?>piece/edit/<?= $piece['id'] ?>" class="btn pull-right">编辑</a>
						<?php } ?>
						<div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
						<script>window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};
						with (document)
						0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
						<h3>作品标题<br><?= $piece['name'] ?></h3>
						<div class="info">
							<div>
								<h3>作品内容</h3><p><?= $piece['description'] ?></p>
							</div>
						</div>
					</div>
				</div>
				<? foreach ($piece['files'] as $file) { ?>
					<div class="model model-b">
						<div class="main">
							<?php if (preg_match('/^image/', $file->file_type)) { ?>
								<img src="<?= $file->url ?>">
							<?php } elseif (preg_match('/^video/', $file->file_type)) { ?>
								<video src="<?= $file->url ?>">
								<?php } ?>
						</div>
					</div>
				<? } ?>
				<div class="model model-b"><br>
					<?php if ($this->user->isLogged(array('witower', 'piece'))) { ?>
						<form class="form-inline" method="post">
							<input type="text" name="amount" placeholder="积分数量">
							<button type="submit" name="award" class="btn">奖励积分给上传者</button>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>

	<div class="rightmax">
		<div class="righttop"><strong>项目详情</strong></div>
		<div class="con">
			<div class="img"><?=$this->image('project', $piece['project']['id'])?></div>
			<h2><a href="/vote/<?= $piece['project']['id'] ?>"><?= $piece['project']['name'] ?></a></h2>
			<div class="hr"></div>
			<div class="p">
				<?=str_getSummary($piece['project']['summary'], 155)?>
			</div>
			<div class="toun">

				<div class="div"><a href="#"><img width="55" height="55" src="<?= site_url() ?>style/dong.png" class="dong">
					<?=$this->image('avatar', $piece['user']['id'], 100, 55)?>
					<span>智塔帮助</span>
				</div>
				<ul>
					<li><a href="<?=site_url()?>space/<?=$piece['user']['id']?>"><?=$piece['user']['name']?></a></li>
					<li>发布了 <?= $this->piece->count(array('user' => $piece['user'])) ?> 个作品</li>
					<li>积分：<span><?= $this->finance->sum(array('user' => $piece['user']['id'], 'item' => '积分')) ?></span></li>
				</ul>
				<div class="rightbottom"></div>
			</div>

		</div>
		<div class="rightbottoms"></div>

	</div>

	<?php $this->view('footer'); ?>
