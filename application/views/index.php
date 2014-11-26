<? $this->view('header') ?>

<div class="head_co">
    <div class="head_l">
		<div id="bigbanner">
			<div id="banners">
				<?=$this->image('project', $homepage_project['id'], false, array(500, 250))?>
			</div>
		</div>
		<div class="head_r">
			<h2><a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"><?= $homepage_project['name'] ?></a></h2>
			<p class="con"><?= str_getSummary($homepage_project['summary'], 140) ?></p>
			<div class="blockd"><font class="fonts">截止时间：<?=$homepage_project['wit_end']?></font><span><?=lang($homepage_project['status'])?></span></div>
			<div class="hr"></div>
			<div class="details cell">
				<ul class="list">
					<li>
						<a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"> <span><?=$homepage_project['comments_count']?></span>
							<p>讨论留言</p>
						</a>
					</li>
					<li>
						<a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"> <span>￥<?=$homepage_project['bonus']?></span>
							<p>项目金额</p>
						</a>
					</li>
					<li>
						<a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"> <span><?=$homepage_project['witters']?></span>
							<p>参与人数</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
    </div>
    <div class="code">
		<div class="code_t"> <img src="<?= site_url() ?>style/erweima.jpg" width="73" height="74" />
			<h2>智塔微信</h2>
			<p>掏出手机扫一扫
				关注智塔
			</p>
		</div>
		<div class="me"><img src="<?= site_url() ?>style/me.jpg"></div>
    </div>
</div>

<div class="centermax" style="width:100%;">
	<div style="width:980px; overflow:hidden; margin:0 auto;">
		<div id="content" class="wrapper<? if ($this->page_name) { ?> page-<?= $this->page_name ?><? } ?>">
			<? if (count($this->page_path) > 1) { ?>
				<ul class="breadcrumb">
					<? foreach ($this->page_path as $level => $page) { ?>
						<li>
							<? if ($level === 0) { ?>
								<strong>
								<? } ?>
								<a href="<?= $page['href'] ?>">
									<?= $page['text'] ?>
								</a>
								<? if ($level === 0) { ?>
								</strong>
							<? } ?>
							<? if ($level < count($this->page_path) - 1) { ?>
								<span class="divider">/</span>
							<? } ?>
						</li>
					<? } ?>
				</ul>
			<? } ?>

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
				<? } ?>

			</div>

			<?php if (!$this->user->isLogged()) { ?>
			<div class="login">
				<p>
					想看更多？请<a href="/signup">注册</a>或<a href="/login">登录</a>
				</p>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= site_url() ?>js/jquery.slides.min.js"></script>
<script type="text/javascript">
jQuery(function ($) {
	$('#slides').slidesjs({
		width: 940,
		height: 210,
		navigation: false,
		play: {
			active: false,
			// [boolean] Generate the play and stop buttons.
			// You cannot use your own buttons. Sorry.
			effect: "fade",
			// [string] Can be either "slide" or "fade".
			interval: 4000,
			// [number] Time spent on each slide in milliseconds.
			auto: true,
			// [boolean] Start playing the slideshow on load.
				swap: false,
				// [boolean] show/hide stop and play buttons
				pauseOnHover: false,
				// [boolean] pause a playing slideshow on hover
				restartDelay: 1000
						// [number] restart delay on inactive slideshow
			}
		});
	});
</script>

<? $this->view('footer') ?>
