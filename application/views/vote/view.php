<? $this->view('header') ?>
<div id="content" class="page-viewvote model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">投票</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<?=$project['name']?>
		</li>
	</ul>
	<div id="left">

		<div class="model model-b">
			<div class="main">
				<div class="info">
					<img src="/uploads/images/avatar/<?=$project['company']?>_100.jpg" />
					<ul>
						<li><b>发布企业：</b><?= $project['company_name'] ?>
							<span><?followButton($project['company'])?></span>
						</li>
						<li><b>发布金额：</b><?= $project['bonus'] ?>元 </li>
						<li><b>被编辑次数：</b><?=$versions?>次<b>被讨论次数：</b><?=count($comments)?>次<b>投票截止日期：</b><?= $project['vote_end'] ?></li>
						<li><b>活动状态：</b>投票中</li>
						<li class="tags">
							<b>标签：</b>
	<?foreach($project['tags'] as $tag){?>
							<a href="＃"><?= $tag ?></a>
	<?}?>
						</li>
					</ul>
				</div>
				<div class="descript">
					<div class="fn-left"><img src="/uploads/images/project/<?=$project['id']?>_100.jpg"></div><div class="fn-right">
						<p><?= $project['summary'] ?></p>
					</div>
				</div>
				<div class="detail">
					<div class="title">公司介绍</div>
					<div class="main">
						<img src="/uploads/images/avatar/<?=$project['company']?>_100.jpg" />
						<p><?//TODO= $company['description'] ?></p>
					</div>
				</div>
				<div class="detail">
					<div class="title">产品说明</div>
					<div class="main">
						<img src="/uploads/images/product/<?=$project['product']?>_100.jpg" />
						<p><?//TODO= $project['summary'] ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b voting">
			<form id="voteForm" method="post">
				<div class="title"><h3>候选人名单及投票</h3></div>
				<div class="tail">
					<div class="button-set">
<?if($voted){?>
						您已经投票了！
<?}else{?>
						<button type="submit" name="vote" class="btn btn-primary">投 票</button>
						<button type="reset" class="btn">重 选</button>
<?}?>						
					</div>
<?if(!$voted){?>
					<div class="flags">
						<img src="/style/flag.png"><img src="/style/flag.png"><img src="/style/flag.png">
					</div>                         
<?}?>						
				</div>
				<div class="main">
					<table>
<?foreach($candidates as $candidate){?>
						<tr>
							<td><img src="/uploads/images/avatar/<?=$candidate['id']?>_100.jpg" width="100px" height="100px"></td>
							<td><?=$candidate['name']?></td>
<?if(!$voted){?>
							<td class="images">
								<img src="/style/flag-off.png"><img src="/style/flag-off.png"><img src="/style/flag-off.png"><input name="candidate[<?=$candidate['id'] ?>]" type="hidden">                                    
							</td>
<?}?>						
							<td><div class="bar <?//= $data['color'] ?>" style="width:<?//= $data['width'] ?>px;"></div><span><?=$candidate['votes']?> (<?=$candidate['votes']/$sum_votes*100?>%)</span></td>
							<td><a href="#">Ta的贡献</a></td>
						</tr>
<?}?>
					</table>
				</div>
				<div class="tail">
					<div class="button-set">
<?if($voted){?>
						您已经投票了！
<?}else{?>
						<button type="submit" name="vote" class="btn btn-primary">投 票</button>
						<button type="reset" class="btn">重 选</button>
<?}?>						
					</div>
				</div>
			</form>
		</div>

	</div>

	<div id="right" class="sidebar">

		<div class="box">

			<div class="title">
				<h3>参与人员（<?=count($voters)?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
<?foreach($voters as $voter){?>
					<li>
						<img src="/uploads/images/avatar/<?=$voter['id']?>_100.jpg" width="50px" height="50px"><a href="/space/<?=$voter['id']?>"><span><?=$voter['name']?></span></a>
						<?followButton($voter['id'])?>                    
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
				<a href="#" ><?//TODO?></a>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<li> <a href="/project/<?//TODO?>"><?//?></a></li>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>投票进行时</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<li> <a href="/vote/<?//?>"><?//?></a></li>
				</ul>
			</div>
		</div>

	</div>
</div>

<?
$this->view('footer')?>