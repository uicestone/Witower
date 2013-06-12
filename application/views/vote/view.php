<? $this->view('header') ?>
<div id="content" class="page-viewvote model-view">
	<div class="breadcrumb">
		投票 > <?=$project['name']?>
	</div>
	<div id="left">

		<div class="model model-b">
			<div class="main">
				<div><img src="/uploads/images/avartar/<?=$project['company']?>_100.jpg" /><br>
					<span>
						<span class="add_attention">已关注</span>
						<a href="javascript:void(0);" class="add_attention" uid="<?= $project['company'] ?>">加关注</a>
					</span>
				</div>
				<ul>
					<li><b>发布企业：</b><?= $project['company_name'] ?></li>
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
				<div class="descript">
					<div class="fn-left"><img src="/uploads/images/project/<?=$project['id']?>_100.jpg"></div><div class="fn-right">
						<p><?= $project['summary'] ?></p>
					</div>
				</div>
				<div class="detail">
					<div class="title">公司介绍</div>
					<div class="main">
						<img src="/uploads/images/avartar/<?=$project['company']?>_100.jpg" />
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
			<form action="{url projectvote-vote}" id="voteForm" method="post">
				<input name="pid" type="hidden" value="<?= $project['id'] ?>">
				<div class="title"><h3>候选人名单及投票</h3></div>
				<div class="tail">
					<div class="button-set">
						您已经投票了！
						<button type="submit" class="btn-a">投 票</button>
						<button type="reset" class="btn-a">重 选</button>                            
					</div>
					<div class="flags">
						<img src="style/flag.png"><img src="style/flag.png"><img src="style/flag.png">
					</div>                         

				</div>
				<div class="main">
					<table>
<?foreach($candidates as $candidate){?>
						<tr>
							<td><img src="/uploads/images/avartar/<?=$candidate['id']?>_100.jpg" /></td>
							<td><?=$candidate['name']?></td>
							<td class="images">
								<img src="style/flag-off.png"><img src="style/flag-off.png"><img src="style/flag-off.png"><input name="uid_<?//= $data['uid'] ?>" type="hidden">                                    
							</td>
							<td><div class="bar <?//= $data['color'] ?>" style="width:<?//= $data['width'] ?>px;"></div><span><?=$candidate['votes']?> (<?=$candidate['votes']/$sum_votes*100?>%)</span></td>
							<td><a href="#">Ta的贡献</a></td>
						</tr>
<?}?>
					</table>
				</div>
				<div class="tail">
					<div class="button-set">
						您已经投票了！
						<button type="submit" class="btn-a">投 票</button>
						<button type="reset" class="btn-a">重 选</button>                            
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
						<img src="/uploads/images/avartar/<?=$voter['id']?>_30.jpg"><a href="/space/<?=$voter['id']?>"><span><?=$voter['name']?></span></a>
						<!--{if $data[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?=$voter['id']?>">加关注</a>
						<!--{/if}-->                        
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