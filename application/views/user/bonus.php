<?$this->view('header')?>
<div id="content" class="page-home model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">用户</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			积分
		</li>
	</ul>
	<div id="left">
		<div class="model">
			<div class="title"><h3>积分</h3></div>
			<div class="main">
				<div class="tab">
				</div>
				<div class="show_content">
					<table class="table table-bordered">
						<thead>
							<tr><td>项目名称</td>
								<td>奖金</td>
								<td>时间</td>
							</tr>
						</thead>
						<tbody>
<?foreach($bonus as $bonus){?>
							<tr>
								<td><?=$bonus['project_name']?></td>
								<td><?=$bonus['bonus']?></td>
								<td><?=date('Y-m-d',$bonus['time'])?></td>
							</tr>
<?}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>