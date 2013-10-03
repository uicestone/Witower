<? $this->view('header') ?>

<div id="content">

<!--<div class="side-nav">
	<ul>
		<li><a href="/project">项目</a></li>
		<li><a href="/user/master">智塔达人</a></li>
		<li><a href="/user/partners">合作伙伴</a></li>
		li><a href="#">他们正在做</a></li
	</ul>
</div>-->

<div class="water">
<?foreach($projects as $project){?>
		<div class="box" style="display: none;">
			<div class="img cell">
				<a href="/<?=in_array($project['status'],array('preparing','witting'))?'project':'vote'?>/<?= $project['id'] ?>">
					<?=$this->image('project',$project['id'],200)?>
				</a>
				<p><?= $project['name'] ?></p>
			</div>
			<div class="details cell">
				项目状态：<?=lang($project['status'])?><br>
				项目金额：<span class="label label-info"><?= $project['bonus'] ?>元</span><br>
				截止日期： <?=in_array($project['status'],array('preparing','witting'))?$project['wit_end']:$project['vote_end']?><br>
				标签：
				<? foreach ($project['tags'] as $tag) { ?>
					<a class="f3" href="#"><?= $tag ?></a>
				<? } ?>
				<ul>
					<a href="/<?=in_array($project['status'],array('preparing','witting'))?'project':'vote'?>/<?= $project['id'] ?>"><li title="参与"><span class="icon-user"></span>(<?= $project['witters'] ?>)</li></a>
					<a href="/<?=in_array($project['status'],array('preparing','witting'))?'project':'vote'?>/<?= $project['id'] ?>"><li title="讨论"><span class="icon-comment"></span>(<?= $project['comments_count'] ?>)</li></a>
					<a href="/<?=in_array($project['status'],array('preparing','witting'))?'project':'vote'?>/<?= $project['id'] ?>"><li title="收藏"><span class="icon-heart"></span>(<?= $project['favorites'] ?>)</li></a>
				</ul>
			</div>
			<div class="users cell">
				<p><? //=$project[summary]   ?></p>
				<ul>
<?	foreach($project['comments'] as $comment){?>
					<li><a href="/space/<?= $comment['user'] ?>"><?=$this->image('avatar',$comment['user'],30)?></a>
						<p><a href="/space/<?= $comment['user'] ?>"><?= $comment['username'] ?>：</a><?= str_getSummary($comment['content'],50) ?></p>
					</li>
<?	}?>
				</ul>
			</div>
			<div class="tail cell"> <a href="/project/<?= $project['id'] ?>"> >>> </a></div>
		</div>
<?}?>
	
</div>

<?if(!$this->user->isLogged()){?>
<div class="login">
	<p>
		想看更多？请<a href="/signup">注册</a>或<a href="/login">登录</a>
	</p>
</div>
<?}?>

</div>

<? $this->view('footer') ?>
