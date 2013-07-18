<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong>企业</strong>
			<span class="divider">/</span>
		</li>
		<li>
			项目管理
		</li>
	</ul>
	<? $this->view('company/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>项目管理</h3></div>
			<div class="main">
				<button class="btn" type="button" onclick="location.href = '/company/addproject'">增加新项目</button>
				<table class="table table-bordered">
					<thead>
						<tr><td>项目名称</td>
							<td style="width:50px">产品</td>
							<td>图片</td><td style="width: 70px;">描述</td><td>时间</td><td>操作</td>
						</tr>
					</thead>
					<tbody>
						<? foreach ($projects as $project) { ?>
							<tr>
								<td><?= $project['name'] ?></td>
								<td><?= $project['product_name'] ?></td>
								<td class="image"><?=$this->image('project',$project['id'],100)?></td>
								<td class="descript"><?=str_getSummary($project['summary'],150)?></td>
								<td style="width: 100px">发布：<br><?= $project['wit_start'] ?><br>截止：<br><?= $project['wit_end'] ?></td>
								<td style="width: 48px;">
									<a href="/project/<?= $project['id'] ?>" class="btn btn-small">查看</a><br>
									<a href="/company/project/<?= $project['id'] ?>" class="btn btn-small">修改</a><br>
									<a href="/company/version?project=<?=$project['id']?>" class="btn btn-small">创意</a><br>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>