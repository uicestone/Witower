<? $this->view('header') ?>
<div id="content" class="page-viewproject model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="/project">项目</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/project/<?=$project['id']?>"><?=$project['name']?></a>
		</li>
	</ul>

	<div id="left">
		<div class="model model-b">
			<div class="main">
				<div class="info">
					<a href="/space/<?=$project['company']?>"><?=$this->image('avatar',$project['company'],100)?></a>
				<ul>
					<li><b>发布企业：</b><?= $project['company_name'] ?>
						<?followButton($project['company'])?>
					</li>
					<li><b>发布金额：</b><?= $project['bonus'] ?>元 </li>
					<li><b>被编辑次数：</b><?= $project['versions'] ?>次&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<b>被讨论次数：</b><?= $project['comments_count'] ?>次&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						<b>项目截止日期：</b><?= $project['wit_end'] ?>
					</li>
					<li><b>活动状态：</b><?=lang($project['status'])?></li>
					<li class="tags">
						<b>标签：</b>
						<?foreach($project['tags'] as $tag){?>
						<a href="#"><?= $tag ?></a>
						<?}?>
					</li>
				</ul>
				</div>
				<div class="info">
					<?=$this->image('project',$project['id'],100)?>
					<div>
						<p><?=$project['summary']?></p>
						<div class="button">
							<div class="fn-left">

							</div>
							<div class="fn-right">
<?if($this->user->id==$project['company']){?>
								<a href="/company/project/<?=$project['id']?>" class="btn">编辑</a>
<?}elseif($this->user->isLogged(array('witower','project'))){?>
								<a href="/admin/project/<?=$project['id']?>" class="btn">编辑</a>
<?}else{?>
								<a class="btn btn-primary"
<?	if(in_array($this->user->id,array_sub($wits,'user'))){?>
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
<?}?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b">
			<div class="title"><h3>目前有<?=count($wits)?>种创意</h3></div>
		</div>
<?foreach($wits as $wit){?>
		<div class="model model-b" id="<?=$wit['latest_version']?>">
			<div class="main">
				<div class="detail">
					<div class="title">
						<h3><a href="/wit/<?=$wit['id']?>"><?= $wit['name'] ?></a><?if($wit['selected']){?><span class="icon-check" title="已选中"></span><?}?></h3>
						<span class="right">
							<a href="/wit/versions/<?=$wit['id']?>" target="_blank">版本</a>
							<?if($project['status']==='witting'){?><a href="/wit/edit/<?=$wit['id']?>" class="btn btn-small btn-primary" style="margin-top: 2px; margin-right: 1em;">编辑</a><?}?>
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
					</div>
				</div>
			</div>
		</div>
<?}?>
		<div class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="title"><h3>公司介绍</h3></div>
					<div class="main">
						<?=$this->image('avatar',$project['company'],100)?>
						<?=$company['description']?>
					</div>
				</div>
				<div class="detail">
					<div class="title"><h3>产品说明</h3></div>
					<div class="main">
						<?=$this->image('product',$project['product'],100)?>
						<?=$product['description']?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--右边栏部分-->
	<div id="right" class="sidebar">
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
		</div>
	</div>
</div>

<?$this->view('footer')?>
