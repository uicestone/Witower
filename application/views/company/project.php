<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title">
				<h3><a href="/<?=uri_segment(1)?>/project">项目管理</a></h3>
				<ul class="nav nav-tabs">
<?foreach(array('preparing','witting','buffering','voting','end') as $status){?>					
					<li<?if(uri_segment(3)===$status){?> class="active"<?}?>>
						<a href="/<?=uri_segment(1)?>/project/<?=$status?>"><?=lang($status)?></a>
					</li>
<?}?>
				</ul>
			</div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/addproject">增加新项目</a>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width:100px">名称</th>
							<th>产品</th>
							<th>描述</th>
							<th>时间</th>
							<th style="width:3.5em">创意</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($projects as $project) { ?>
							<tr>
								<td>
									<a href="/project/<?= $project['id'] ?>"><?= $project['name'] ?></a>
									<?=$this->image('project',$project['id'],100)?>
									<span class="label"><?=lang($project['status'])?></span>
									<a href="/<?=uri_segment(1)?>/project/<?= $project['id'] ?>" class="btn btn-small" style="margin-top:5px;">修改</a><br>
								</td>
								<td>
									<?= $project['product_name'] ?>
								</td>
								<td class="descript"><?=str_getSummary($project['summary'],250)?></td>
								<td style="width: 100px">
									<?= $project['wit_start'] ?> - <?= $project['wit_end'] ?>
									<hr>
									<?= $project['vote_start'] ?> - <?= $project['vote_end'] ?>
								</td>
								<td style="width: 48px;">
									<a href="/<?=uri_segment(1)?>/wit?project=<?=$project['id']?>">查看</a><br>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
<?$this->view('footer')?>