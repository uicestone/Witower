<?$this->view('header')?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
<?if(isset($project)){?>
		<li>
			<a href="/<?=uri_segment(1)?>/project">项目管理</a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/project/<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
<?}?>
		<li>
			创意
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>创意</h3></div>
			<div class="main">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th id="name">标题</th>
							<th id="summary">摘要</th>
							<th id="author">发布</th>
							<th id="latest-author">最后编辑</th>
							<th id="versions">版本数</th>
						</tr>
					</thead>
					<tbody>
<?foreach($wits as $wit){?>
						<tr>
							<td><a href="/wit/<?=$wit['id']?>"><?=$wit['name']?></a></td>
							<td><?=str_getSummary($wit['content'],164)?></td>
							<td><?=$wit['username']?> - <?=date('Y-m-d H:i',$wit['time'])?></td>
							<td><?=$wit['latest_version_username']?> - <?=date('Y-m-d H:i',$wit['latest_version_time'])?></td>
							<td>
								<a href="/<?=uri_segment(1)?>/version?wit=<?=$wit['id']?>" class="btn btn-small"><?=$wit['versions']?> 查看</a>
							</td>
						</tr>
<?}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>