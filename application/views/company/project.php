<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/project">项目管理</a>
<?if(uri_segment(3)){?>
			<span class="divider">/</span>
<?}?>
		</li>
<?if(uri_segment(3)){?>
		<li>
			<?=lang(uri_segment(3))?>
		</li>
<?}?>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
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
							<th>项目名称</th>
							<th>产品</th>
							<th>图片</th>
							<th>描述</th>
							<th>时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($projects as $project) { ?>
							<tr>
								<td><a href="/project/<?= $project['id'] ?>"><?= $project['name'] ?></a></td>
								<td><?= $project['product_name'] ?></td>
								<td class="image"><?=$this->image('project',$project['id'],100)?></td>
								<td class="descript"><?=str_getSummary($project['summary'],150)?></td>
								<td style="width: 100px"><?= $project['wit_start'] ?> - <?= $project['wit_end'] ?></td>
								<td style="width: 48px;">
									<a href="/<?=uri_segment(1)?>/project/<?= $project['id'] ?>" class="btn btn-small">修改</a><br>
									<a href="/<?=uri_segment(1)?>/wit?project=<?=$project['id']?>" class="btn btn-small">创意</a><br>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>