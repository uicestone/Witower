<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">企业</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			创意版本
		</li>
	</ul>
	<? $this->view('company/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>创意版本</h3></div>
			<div class="main">
				<form method="post">
					<table class="table table-bordered">
						<thead>
							<tr><th id="name">创意标题</th>
								<th id="project">项目</th>
								<th>内容</th>
								<th id="date">作者/时间</th>
								<th id="score">评分</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($versions as $version) { ?>
								<tr>
									<td id="name"><?= $version['wit_name'] ?></td>
									<td id="project"><?= $version['project_name'] ?></td>
									<td><?= $version['content'] ?></td>
									<td id="date">
										<p><?= $version['username'] ?></p>
										<p><?= date('Y-m-d', $version['time']) ?></p>
									</td>
									<td id="score">
										<input type="text" name="score[<?= $version['id'] ?>]" value="<?= $version['score_company'] ?>" />
									</td>
								</tr>
							<? } ?>								
						</tbody>
					</table>
					<button type="submit" name="submit" class="btn">保存</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?
$this->view('footer')?>