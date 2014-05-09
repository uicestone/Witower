<? $this->view('header') ?>
	<div id="left" class="span9">

		<div class="model model-b">
			<div class="main">
				<div class="info">
<?if($this->user->isLogged(array('witower','vote')) && $project['status']==='voting'){?>
					<a href="/project/end/<?=$project['id']?>" class="btn pull-right">结束投票</a>
<?}?>
					<?=$this->image('avatar',$project['company'],100)?>
					<ul>
						<li><b>发布企业：</b><?= $project['company_name'] ?>
							<span><?followButton($project['company'])?></span>
						</li>
						<li><b>发布金额：</b><?= $project['bonus'] ?>元 </li>
						<li>
							<b>被编辑次数：</b><?=$versions?>次&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>被讨论次数：</b><?=count($comments)?>次&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>投票截止日期：</b><?= $project['vote_end'] ?>
						</li>
						<li><b>活动状态：</b><?=lang($project['status'])?></li>
						<li class="tags">
							<b>标签：</b>
	<?foreach($project['tags'] as $tag){?>
							<a href="＃"><?= $tag ?></a>
	<?}?>
						</li>
					</ul>
					<wb:share-button appkey="4DEu5v" addition="simple" type="button" ralateUid="3901986632"></wb:share-button>
				</div>
				<div class="info">
					<?=$this->image('project',$project['id'],100)?>
					<div>
						<p><?= $project['summary'] ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b voting">
			<form id="voteForm" method="post">
				<div class="title"><h3>候选人名单及投票</h3></div>
				<div class="tail">
					<div class="button-set">
<?if($project['status']!=='voting'){?>
						项目不在投票阶段
<?}elseif($voted){?>
						您已经投票了！
<?}elseif($this->user->id==$project['company']){?>
						<a href="/company/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}elseif($this->user->isLogged(array('witower','project'))){?>
						<a href="/admin/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}else{?>
						<a id="vote-button" href="#vote-confirm-modal" role="button" class="btn btn-primary" data-toggle="modal">投票</a>

						<div id="vote-confirm-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4>确认投票</h4>
							</div>
							<div class="modal-body hide" id="completed">
								您已经进行个人投票，投票后结果无法更改，确认请点击”投票“；点击”取消“返回进行修改”
							</div>
							<div class="modal-body hide" id="incompleted">
								您已经进行个人投票，每个人可以投的票数为3，目前您投的票数不足，确定请点击“投票”；点击“取消”返回进行修改
							</div>
							<div class="modal-footer">
								<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
								<button type="submit" name="vote" class="btn btn-primary">投票</button>
							</div>
						</div>	
						
						<button type="reset" class="btn">重选</button>
<?}?>						
					</div>
<?if($project['status']==='voting' && !$voted){?>
					<div class="flags">
						<img src="/style/flag.png"><img src="/style/flag.png"><img src="/style/flag.png">
					</div>                         
<?}?>						
				</div>
				<div class="main">
					<table>
<?foreach($candidates as $candidate){?>
						<tr>
							<td><?=$this->image('avatar',$candidate['id'],'100')?></td>
							<td><?=$candidate['name']?></td>
<?if(!$voted){?>
							<td class="images">
								<img src="/style/flag-off.png"><img src="/style/flag-off.png"><img src="/style/flag-off.png"><input name="candidate[<?=$candidate['id'] ?>]" type="hidden">                                    
							</td>
<?}?>						
							<td>
								<div class="bar" style="width:<?if($sum_votes==0){?>0<?}else{?><?=round($candidate['votes']/$sum_votes*100,1)?><?}?>px; background-color:#<?=dechex(rand(0,15)),dechex(rand(0,7)),dechex(rand(0,15))?>"></div>
								<span><?=$candidate['votes']?> (<?if($sum_votes==0){?>尚无投票<?}else{?><?=round($candidate['votes']/$sum_votes*100,1)?>%<?}?>)</span></td>
							<td><a href="/wit/versions/<?=$wit['id']?>?user=<?=$candidate['id']?>" target="_blank">Ta的贡献</a></td>
						</tr>
<?}?>
					</table>
				</div>
				<div class="tail">
					<div class="button-set">
<?if($project['status']!=='voting'){?>
						项目不在投票阶段
<?}elseif($voted){?>
						您已经投票了！
<?}elseif($this->user->id==$project['company']){?>
						<a href="/company/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}elseif($this->user->isLogged(array('witower','project'))){?>
						<a href="/admin/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}else{?>
						<a href="#vote-confirm-modal" role="button" class="btn btn-primary" data-toggle="modal">投票</a>
						<button type="reset" class="btn">重选</button>
<?}?>						
					</div>
				</div>
			</form>
		</div>
<?if($wit){?>
		<div class="model model-b">
			<div class="title">
				<a href="/wit/<?=$wit['id']?>" target="_blank"><h3><?=$wit['name']?></h3></a>
				<span class="pull-right">
					<a href="/wit/versions/<?=$wit['id']?>" target="_blank">版本</a>
				</span>
			</div>
			<div class="main">
				<?=$wit['content']?>
			</div>
		</div>
<?}?>
		<div class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="title">公司介绍</div>
					<div class="main">
						<a href="/space/<?=$project['company']?>"><?=$this->image('avatar',$project['company'],100)?></a>
						<p><?=$company['description'] ?></p>
					</div>
				</div>
				<div class="detail">
					<div class="title">产品说明</div>
					<div class="main">
						<?=$this->image('product',$project['product'],100)?>
						<p><?=$product['description'] ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="right" class="sidebar span3">

		<div class="box">

			<div class="title">
				<h3>参与人员（<?=count($voters)?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
<?foreach($voters as $voter){?>
					<li>
						<a href="/space/<?=$voter['id']?>">
							<?=$this->image('avatar',$voter['id'],100,50)?>
							<span class="ellipsis"><?=$voter['name']?></span>
						</a>
						<?followButton($voter['id'])?>                    
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

<script type="text/javascript">
$(function(){
	$('#vote-button').on('click',function(){
		var votes=0;
		
		$(this).parents('form').find(':input[name^=candidate]').each(function(){
			votes += Number($(this).val());
		});
		
		if(votes===3){
			$(this).parents('form').find('#completed').show().siblings('#incompleted').hide();
		}else{
			$(this).parents('form').find('#incompleted').show().siblings('#completed').hide();
		}
	});
});
</script>

<?$this->view('footer')?>
