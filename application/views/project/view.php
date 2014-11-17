<? $this->view('header') ?>
	<div id="left" class="span9" >
    <div class="reday1" style="margin-top:0;">
  <div class="maxred">
    <div class="img"><?=$this->image('project',$project['id'])?></div>
    <div class="reday_r">
      <h2><?=$project['name']?></h2>
<h4>项目描述</h4><?=$project['summary']?>
<strong>企业名称：</strong><?= $project['company_name'] ?><span><img src="<?=site_url()?>style/guanzhu.png" /></span>
&nbsp;<strong>活动状态：</strong><?=lang($project['status'])?>
&nbsp;<strong>项目金额：</strong><span><?= $project['bonus'] ?></span>元<br>
<strong>截止时间：</strong><?= $project['wit_end'] ?>
&nbsp;<strong>被编辑次数：</strong><?= $project['versions'] ?>次&nbsp;&nbsp;<strong>被讨论次数：</strong><?= $project['comments_count'] ?>次
<br><strong>标签：</strong>
						<?foreach($project['tags'] as $tag){?>
						<a href="#"><?= $tag ?></a>
						<?}?><div class=""><div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    </div>

  </div>
  <div class="tlrs">当前参与人员</div>
  <div class="list1">
    <div class="left"><img src="<?=site_url()?>style/left.png" /></div>
    <div class="maxul">
   		<ul>
					<?foreach($witters as $witter){?>
					<li>
						<a href="/space/<?= $witter['id'] ?>">
							<?=$this->image('avatar',$witter['id'],100,50)?>
							<span><?= $witter['name'] ?></span>
						</a>
						<?followButton($witter['id'])?>
					</li>
					<?}?>
				</ul>
    </div>
    <div class="right"><img src="<?=site_url()?>style/right.png" /></div>
  </div>
</div>
<div id="left" style="width:980px;margin-left:-4px;"><br>
		<div class="model model-b" >
			<div class="title" ><h3 style="color:#00A7EB;">目前有<?=count($wits)?>种创意</h3>	
			<?if($this->user->id==$project['company'] && !$this->user->is_muted){?>
								<a href="/company/project/<?=$project['id']?>" class="btn">编辑</a>
<?}elseif($this->user->isLogged(array('witower','project')) && !$this->user->is_muted){?>
								<a href="/admin/project/<?=$project['id']?>" class="btn">编辑</a>
<?}else{?>
								<a class="btn btn-primary"
<?	if($this->user->is_muted){?>
								   disabled="disabled" title="您已被禁言"
<?	}?>
<?	if(in_array($this->user->id,array_column($wits,'user'))){?>
								   disabled="disabled" title="您已经发起了1个创意"
<?	}?>
<?	if(count($wits)>=$this->config->user_item('max_wits_per_project')){?>
								   disabled="disabled" title="本项目创意限额已满"
<?	}?>
<?	if($project['status']!=='witting'){?>
								   disabled="disabled" title="项目不在征集创意状态"
<?	}?>
								   href="/wit/add?project=<?=$project['id']?>">发布创意</a>
<?}?>
<?if($this->user->isLogged(array('witower','help'))){?>
								<a class="btn btn-primary" href="/wit/add?project=<?=$project['id']?>">发布创意</a>
<?}?></div>
		</div>
<?foreach($wits as $wit){?>
		<div class="model model-b"  id="<?=$wit['latest_version']?>">
			<div class="main" >
				<div class="detail" style="width:950px">
					<div class="title" >
						<h3><a href="/wit/<?=$wit['id']?>"><?= $wit['name'] ?></a><?if($wit['selected']){?><span class="icon-check" title="已选中"></span><?}?></h3>
						<span class="right">
							<a href="/wit/versions/<?=$wit['id']?>" target="_blank">版本</a>
<?if(($this->user->isLogged(array('witower','wit')) || $this->user->id==$project['id']) && $project['status']==='buffering'){?>
<?	if($wit['selected']){?>
							<a href="/wit/unselect/<?=$wit['id']?>" class="btn btn-small" style="margin-top: 2px; margin-right: 1em;">取消选中此创意</a>
<?	}else{?>
							<a href="/wit/select/<?=$wit['id']?>" class="btn btn-small" style="margin-top: 2px; margin-right: 1em;">选中此创意</a>
<?	}?>
<?}?>
							<?if($project['status']==='witting' && !$this->user->is_muted){?><a href="/wit/edit/<?=$wit['id']?>" class="btn btn-small btn-primary" style="margin-top: 2px; margin-right: 1em;">编辑</a><?}?>
						</span>
					</div>
					<div class="main">
						<p><?= $wit['content'] ?></p>
					</div>
					<div class="tail icons">
						<ul>
							<li><span class="icon-comment"></span><a href="#" class="btn-comment">评论(<?=count($wit['comments'])?>)</a></li>
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
<?foreach($wit['comments'] as $comment){?>
							<li>
								<dl class="dl-horizontal">
									<dt>
										<a href="/space/<?=$comment['user']?>"><?=$this->image('avatar',$comment['user'],100,30)?></a>
									</dt>
									<dd>
										<p class="avatar">
											<a href="/space/<?=$comment['user']?>"><?=$comment['username']?></a>
										</p>
										<p class="content">
											<?=$comment['content']?>
											<span class="time">( <?=date('Y-m-d H:i:s',$comment['time'])?>) </span>
										</p>
									</dd>
								</dl>
							</li>
<?}?>
						</ul>
						<button class="close-comment-list btn btn-mini pull-right"><span class="icon-chevron-up"></span>收起评论</button>
					</div>
				</div>
			</div>
		</div>
<?}?>
		<div class="model model-b">
			<div class="main" >
				<div class="detail" style="width:940px;">
					<div class="title" ><h3>公司介绍</h3></div>
					<div class="main">
						<?=$this->image('avatar',$project['company'],200)?>
						<?=$company['description']?>
					</div>
				</div>
				<div class="detail" style="width:940px;">
					<div class="title"><h3>产品说明</h3></div>
					<div class="main">
						<?=$this->image('product',$project['product'],200)?>
						<?=$product['description']?>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--右边栏部分-->
<!--	<div id="right" class="sidebar span3">
		<div class="box">
			<div class="title">
				<h3>参与人员（<?= $witters_count ?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
					<?foreach($witters as $witter){?>
					<li>
						<a href="/space/<?= $witter['id'] ?>">
							<?=$this->image('avatar',$witter['id'],100,50)?>
							<span><?= $witter['name'] ?></span>
						</a>
						<?followButton($witter['id'])?>
					</li>
					<?}?>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>热门的标签</h3>
			</div>
			<div class="main tags-cloud">
				<?foreach($hot_tags as $tag){?>
				<a href="/project?tag=<?=$tag?>" ><?= $tag ?></a>
				<?}?>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="/project" target="_blank" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<? foreach ($recommended_projects as $project){?>
					<li> <a href="/project/<?= $project['id']?>"><?= $project['name']?></a></li>
					<?}?>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>投票进行时</h3><a href="/vote" target="_blank" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<?foreach($recommended_votes as  $project){?>
						<li> <a href="/vote/<?=$project['id']?>"><?=$project['name']?></a></li>
					<?}?>
				</ul>
			</div>
		</div>	</div>-->
<!--
<div class="reday">
  <div class="maxred">
    <div class="img"><?=$this->image('project',$project['id'])?></div>
    <div class="reday_r">
      <h2>3M净化器广告文案撰写征集</h2>
      <p>雾霾天气日益增多，如何让3M的安全防护产品之一的口罩，给您带来贴心的保护，享受喧嚣中片刻的宁静？征集可独立拍成视频的创意广告！</p>
      <ul>
        <li>文案主题：不限（搞笑，温情，balbalba）</li>
        <li>产品定位：大众日常消费用品</li>
        <li>文案要求：新颖、独特、适合拍摄成视频形式</li>
        <li>预计时场：2-5分钟</li>
        <li>发布企业：云兆文化 <span><img src="<?=site_url()?>style/guanzhu.png" /></span></li>
        <li>活动状态：进行中</li>
        <li>项目金额：<span>800.00</span>元</li>
        <li>截止时间：2014年09月31日</li>
      </ul>
      <div class="div"><a href="#"><img src="<?=site_url()?>style/woyaocanyu.png" /></a></div>
    </div>
  </div>
  <div class="tlrs">当前参与人员</div>
  <div class="list1">
    <div class="left"><img src="<?=site_url()?>style/left.png" /></div>
    <div class="maxul">
   		<ul>
					<?foreach($witters as $witter){?>
					<li>
						<a href="/space/<?= $witter['id'] ?>">
							<?=$this->image('avatar',$witter['id'],100,50)?>
							<span><?= $witter['name'] ?></span>
						</a>
						<?followButton($witter['id'])?>
					</li>
					<?}?>
				</ul>
    </div>
    <div class="right"><img src="<?=site_url()?>style/right.png" /></div>
  </div>
</div>-->

<?$this->view('footer')?>
