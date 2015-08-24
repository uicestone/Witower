<? $this->view('header') ?>
<style>
.gaoliang{background-color: blue;padding :3px; color: white;}

 a.gaoliang:link, a.gaoliang:visited{color: white;}
</style>
<link href="<?=base_url()?>style/xiangmuxiangxi2.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>style/style.css" rel="stylesheet" type="text/css" />
<div class="indexDiv">
        <div class="heading"><?= $project['name'] ?></div>
		<?= $this->image('project', $project['id'],null,array('100%',null))?>
        <div class="content">
            <div class="section">项目描述 : <span><?= $project['summary'] ?></span></div>
            <div class="section1">企业名称 : <span><?= $project['company_name'] ?></span>
                <input type="button" name="" value="关注" id="button1">
            </div>
            <div class="section">活动状态 : <span><?= lang($project['status']) ?></span></div>
            <div class="section">项目金额 : <span id="i"><?= $project['bonus'] ?>元</span></div>
            <div class="section">截止时间 : <span id="ii"><?= $project['wit_end'] ?></span></br>
            <span id="ii">被编辑次数 : <?= $project['versions'] ?>次</span></br>
            <span id="ii">被讨论次数 : <?= $project['comments_count'] ?>次</span></div>
        </div>
        <div class="image">
           <? foreach ($project['tags'] as $tag) { ?>
				<a href="#"><?= $tag ?></a>
			<? } ?><div class=""><div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div></div>
			<script>window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};
with (document)
	0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
        </div>
        <div class="hx"></div>
        <br/><br/>
        <div class="heading1">当前参与人员</div>
        <div class="bg1">
            <div class="container">
                <div id="ca-container" class="ca-container">
                    <div class="ca-wrapper">
						<? foreach ($witters as $witter) { ?>
						<div class="ca-item" >
						<a href="/space/<?= $witter['id'] ?>">
							<?= $this->image('avatar', $witter['id'], 100, 50) ?>
							<br>
							<span><?= $witter['name'] ?></span>
						</a>
                        </div>
						<? } ?>
					</div>
                </div>
            </div>
        </div>
        <div class="bg2">
            <div class="i">目前有<?= count($wits) ?>种创意
            <? if ($this->user->id == $project['company'] && !$this->user->is_muted) { ?>
				<a class="gaoliang" href="<?=site_url()?>/company/project/<?= $project['id'] ?>" class="btn">编辑</a>
			<? } elseif ($this->user->isLogged(array('witower', 'project')) && !$this->user->is_muted) { ?>
				<a class="gaoliang" href="<?=site_url()?>/admin/project/<?= $project['id'] ?>" class="btn">编辑</a>
			<? } else { ?>
				<a class="btn btn-primary"
				<? if ($this->user->is_muted) { ?>
					   disabled="disabled" title="您已被禁言"
				   <? } ?>
				   <? if (in_array($this->user->id, array_column($wits, 'user'))) { ?>
					   disabled="disabled" title="您已经发起了1个创意"
				   <? } ?>
				   <? if (count($wits) >= $this->config->user_item('max_wits_per_project')) { ?>
					   disabled="disabled" title="本项目创意限额已满"
				   <? } ?>
				   <? if ($project['status'] !== 'witting') { ?>
					   disabled="disabled" title="项目不在征集创意状态"
				   <? } ?>
				   href="<?=site_url()?>/wit/add?project=<?= $project['id'] ?>">发布创意</a>
			   <? } ?>
			   <? if ($this->user->isLogged(array('witower', 'help'))) { ?>
				<a class="btn btn-primary" href="<?=site_url()?>/wit/add?project=<?= $project['id'] ?>">发布创意</a>
			<? } ?>

            </div>
        </div>
        	<? foreach ($wits as $wit) { ?>
		    <div class="all">
                <div class="left">

                    <a href="<?=site_url()?>/wit/<?= $wit['id'] ?>"><?= $wit['name'] ?></a><? if ($wit['selected']) { ?><span class="icon-check" title="已选中"></span><? } ?></h3>
                </div>
                <div class="right">

                    <a class="gaoliang" href="<?=site_url()?>/wit/versions/<?= $wit['id'] ?>" target="_blank" >版本</a>
               		<? if (($this->user->isLogged(array('witower', 'wit')) || $this->user->id == $project['id']) && $project['status'] === 'buffering') { ?>
								<? if ($wit['selected']) { ?>
									<a href="<?=site_url()?>/wit/unselect/<?= $wit['id'] ?>" class="btn btn-small" style="margin-top: 2px; margin-right: 1em;">取消选中此创意</a>
								<? } else { ?>
									<a href="<?=site_url()?>/wit/select/<?= $wit['id'] ?>" class="btn btn-small" style="margin-top: 2px; margin-right: 1em;">选中此创意</a>
								<? } ?>
							<? } ?>
							<? if ($project['status'] === 'witting' && !$this->user->is_muted) { ?><a class="gaoliang" href="<?=site_url()?>/wit/edit/<?= $wit['id'] ?>" class="btn btn-small btn-primary" style="margin-top: 2px; margin-right: 1em;">编辑</a><? } ?>
                </div>
            </div>
        <div class="bg3">
            <?= $wit['content'] ?>
        </div>
        <div class="tail icons model" id="<?= $wit['latest_version'] ?>">
					<div >	
						<ul>
							<li><span class="icon-comment"></span><a href="#" class="btn-comment">评论(<?= count($wit['comments']) ?>)</a></li>
						</ul>
					</div>
        			<div class="sub_comment" style="display:none">
						<div class="comment">
							<form>
								<textarea name="comment-content" class="comment-field" placeholder="评论内容" rows="1"></textarea>
								<button type="button" name="comment-content-submit" class="btn">提交</button>
							</form>
						</div>
						<ul class="comment-list">
							<? foreach ($wit['comments'] as $comment) { ?>
								<li>
									<dl class="dl-horizontal">
										<dt>
										<a href="<?=site_url()?>space/<?= $comment['user'] ?>">
										<?= $this->image('avatar', $comment['user'], 100, 30) ?>
										</dt>
										<dd>
											<p class="avatar">
												<a href="<?=site_url()?>/space/<?= $comment['user'] ?>"><?= $comment['username'] ?></a>
											</p>
											<p class="content">
												<?= $comment['content'] ?>
												<span class="time">( <?= date('Y-m-d H:i:s', $comment['time']) ?>) </span>
											</p>
										</dd>
									</dl>
								</li>
							<? } ?>
						</ul>
						<button class="close-comment-list btn btn-mini pull-right"><span class="icon-chevron-up"></span>收起评论</button>
					</div>
					</div>
   <? } ?>
        <div class="hx"></div>
        <div class="heading1">公司介绍</div>
        <div class="hx2"></div>
        <div class="content2">
            <div class="pic"><img src="<?=base_url()?>uploads/images/avatar/<?=$project['company']?>.jpg"></div>
            <div class="word"><?= $company['description'] ?></div>
        </div>
        <div class="heading1">产品说明</div>
        <div class="hx2"></div>
        <div class="content2">
            <div class="pic"><img src="<?=base_url()?>uploads/images/product/<?=$project['product']?>.jpg"></div>
            <div class="word"><?= $product['description'] ?></div>
        </div>
    </div>
<script type="text/javascript" src="<?=base_url()?>script/jquery.easing.1.3.js"></script>
<!-- the jScrollPane script -->
<script type="text/javascript" src="<?=base_url()?>script/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?=base_url()?>script/jquery.contentcarousel.js"></script>
<script type="text/javascript">
    $('#ca-container').contentcarousel();
</script>

<? $this->view('footer') ?>
