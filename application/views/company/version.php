<?$this->view('header')?>
<div id="content" class="page-company">
	<div class="breadcrumb">
		<strong>企业</strong> >> 创意版本
	</div>
	<?$this->view('company/sidebar')?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>创意版本</h3></div>
			<div class="main">
				<div class="tab">
				</div>
				<div class="show_content">
					<form method="post">
						<table class="table table-bordered">
							<thead>
								<tr><td>创意标题</td>
									<td>项目</td>
									<td>内容</td>
									<td>时间</td>
									<td>评分</td>
								</tr>
							</thead>
							<tbody>
<?foreach($versions as $version){?>
								<tr>
									<td><?=$version['wit_name']?></td>
									<td><?=$version['project_name']?></td>
									<td><?=$version['content']?></td>
									<td><?=date('Y-m-d',$version['time'])?></td>
									<td>
										<input type="text" name="score[<?=$version['id']?>]" value="<?=$version['score_company']?>" />
									</td>
								</tr>
<?}?>								
							</tbody>
						</table>
						<button type="submit" name="submit" class="btn">保存</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>