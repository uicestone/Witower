<? $this->view('header') ?>

<div id="content">

<div class="side-nav">
	<ul>
		<li><a href="/project">项目</a></li>
		<li><a href="/user/master">智塔达人</a></li>
		<li><a href="/user/partners">合作伙伴</a></li>
		<!--li><a href="#">他们正在做</a></li-->
	</ul>
</div>

<div class="water">
	<? foreach ($projects as $project) {?>
		<div class="box" style="display: none;">
			<div class="img cell">
				<a href="/project/<?= $project['id'] ?>">
					<?=$this->image('project',$project['id'],200)?>
				</a>
				<p><?= $project['name'] ?></p>
			</div>
			<div class="details cell">
				项目金额 ：<span class="price"><?= $project['bonus'] ?>元</span><br>
				截止日期 ： <?=$project['wit_end']?><br>
				标签：
				<? foreach ($project['tags'] as $tag) { ?>
					<a class="f3" href="#"><?= $tag ?></a>
				<? } ?>
				<ul>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-1" title="参与">(<?= $project['witters'] ?>)</li></a>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-2" title="讨论">(<?= $project['comments_count'] ?>)</li></a>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-3" title="收藏">(<?= $project['favorites'] ?>)</li></a>
				</ul>
			</div>
			<div class="users cell">
				<p><? //=$project[summary]   ?></p>
				<ul>
					<? foreach ($project['comments'] as $comment) { ?>
								<li><a href="/space/<?= $comment['user'] ?>"><?=$this->image('avatar',$comment['user'],30)?></a>
							<p><a href="/space/<?= $comment['user'] ?>"><?= $comment['username'] ?>：</a><?= $comment['content'] ?></p>
						</li>
					<? } ?>
				</ul>
			</div>
			<div class="tail cell"> <a href="/project/<?= $project['id'] ?>"> >>> </a></div>
		</div>
	<? } ?>
	
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
