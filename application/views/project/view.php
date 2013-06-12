<? $this->view('header') ?>
<div id="content" class="page-viewproject model-view">
	<div class="breadcrumb">
		项目 > <?=$project['name']?>
	</div>

	<div id="left">
		<div class="model model-b">
			<div class="main">
				<div class="info">
					<a href="/space/<?=$project['company']?>"><img src="/uploads/images/avartar/<?=$project['company']?>_100.jpg"></a>
				<ul>
					<li><b>发布企业：</b><?= $project['company_name'] ?>
<?if($this->user->hasFollowed($project['company'])){?>
						<span class="add_attention">已关注</span>
<?}else{?>
						<a href="javascript:void(0);" class="add_attention" uid="<?=$project['company']?>">加关注</a>
<?}?>
					</li>
					<li><b>发布金额：</b><?= $project['bonus'] ?>元 </li>
					<li><b>被编辑次数：</b><?= $project['versions'] ?>次
						<b>被讨论次数：</b><?= $project['comments_count'] ?>次<b>
						项目截止日期：</b><?= $project['wit_end'] ?>
					</li>
					<li><b>活动状态：</b>进行中 </li>
					<li class="tags">
						<b>标签：</b>
						<?foreach($project['tags'] as $tag){?>
						<a href="#"><?= $tag ?></a>
						<?}?>
					</li>
				</ul>
				</div>
				<div class="descript">
					<div class="fn-left"><img src="/uploads/images/project/<?=$project['id']?>_100.jpg"></div><div class="fn-right">
						<p><?=$project['summary']?></p>
						<div class="button">
							<div class="fn-left">

							</div>
							<div class="fn-right">
								<a class="btn-c" href="/wit/add">发布创意</a>
							</div>

						</div>
					</div>
				</div>
				<div class="detail">
					<div class="title"><h3>公司介绍</h3></div>
					<div class="main">
						<img src="/uploads/images/avartar/<?=$project['company']?>_100.jpg">
						<p>杭州疑现“卖肾基地” 一颗肾行价3.5万元】据媒体报道，杭州一小区内存在非法肾源供养基地，住在“卖肾基地肾基地”中的都是年轻男子，卖肾原因有还债、嫌打工赚钱慢等。该基地内有30余名供”中的都是年轻男子，国内统一行价3.5万元。记者5月28日获悉，杭州警方目前已介入调查。</p>
					</div>
				</div>
				<div class="detail">
					<div class="title"><h3>产品说明</h3></div>
					<div class="main">
						<img src="/uploads/images/product/<?=$project['product']?>_100.jpg">
						<p>杭州疑现“卖肾基地” 一颗肾行价3.5万元】据媒体报道，杭州一小区内存在非法肾源供养基地，住在“卖肾基地肾基地”中的都是年轻男子，卖肾原因有还债、嫌打工赚钱慢等。该基地内有30余名供”中的都是年轻男子，国内统一行价3.5万元。记者5月28日获悉，杭州警方目前已介入调查。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b">
			<div class="title"><h3>目前有<?=count($wits)?>种创意</h3></div>
			<div class="main">

				<?foreach($wits as $wit){?>
				<div class="detail">
					<div class="title">
						<h3><?= $wit['name'] ?></h3>
						<a href="/wit/<?=$wit['id']?>" target="_blank">版本</a>
						<a href="/wit/edit/<?=$wit['id']?>" class="edit">编辑</a>
					</div>
					<div class="main">
						<p><?= $wit['content'] ?></p>
					</div>
					<div class="tail icons">
						<ul>
							<li class="cat-2"><a href="#">(<?=count($wit['comments'])?>)</a></li>
						</ul>
					</div>
				</div>
				<?}?>


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
					<?foreach($witters as $participant){?>
					<li>
						<img src="/uploads/images/avartar/<?=$participant['id']?>_100.jpg" width="50"><a href="/space/<?= $participant['id'] ?>"><span><?= $participant['name'] ?></span></a>
<?if($this->user->hasFollowed($participant['id'])){?>
						<span class="add_attention">已关注</span>
<?}else{?>
						<a href="javascript:void(0);" class="add_attention" uid="<?=$participant['id']?>">加关注</a>
<?}?>
					</li>
					<?}?>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>热门的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<?foreach($hot_tags as $project){?>
				<a href="/project/<?= $project?>" ><?= $project ?></a>
				<?}?>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="#" class="more">more</a>
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
				<h3>投票进行时</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<?foreach($recommended_votes as  $project){?>
					<li> <a href="index.php?projectvote-view-<?= $project['id'] ?>"><?= $project['name'] ?></a></li>
					<?}?>
				</ul>
			</div>
		</div>

	</div>
</div>


<?
$this->view('footer')?>
