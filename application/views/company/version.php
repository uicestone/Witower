<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong>企业</strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/company/version">创意版本</a>
<?if(isset($wit) || isset($project)){?>
			<span class="divider">/</span>
		</li>
<?}?>
<?if(isset($wit)){?>
		<li>
			<a href="/company/version?project=<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
		<li>
			<?=$wit['name']?>
		</li>
<?}elseif(isset($project)){?>
		<li>
			<a href="/company/version?project=<?=$project['id']?>"><?=$project['name']?></a>
		</li>
<?}?>
	</ul>
	<? $this->view('company/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>创意版本</h3></div>
			<div class="main">
				<form method="post">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th id="name">创意标题</th>
								<th id="num" style="width:2em;">版本</th>
<?if(!isset($project) && !isset($wit)){?>
								<th id="project">项目</th>
<?}?>
								<th>内容</th>
								<th id="date">作者/时间</th>
								<th id="score">评分</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($versions as $version) { ?>
								<tr>
									<td id="name"><a href="/wit/<?=$version['wit']?>" target="_blank"><?=$version['wit_name']?>
										<?if(!isset($wit)){?><a href="/company/version?wit=<?=$version['wit']?>"><span class="icon-filter pull-right"></span></a><?}?>
									</td>
									<td id="num" style="text-align: center;"><a href="/version/<?=$version['id']?>" target="_blank"><?=$version['num']?></td>
<?if(!isset($project) && !isset($wit)){?>
									<td id="project">
										<a href="/project/<?=$version['project']?>" target="_blank"><?=$version['project_name']?></a>
										<?if(!isset($project)){?><a href="/company/version?project=<?=$version['project']?>"><span class="icon-filter pull-right"></span></a><?}?>
									</td>
<?}?>
									<td><?=str_getSummary($version['content'],164)?></td>
									<td id="date">
										<p><?=$version['username']?></p>
										<p><?=date('Y-m-d', $version['time'])?></p>
									</td>
									<td id="score">
										<input type="text" name="score[<?= $version['id'] ?>]" value="<?= $version['score_company'] ?>" />
									</td>
								</tr>
							<? } ?>								
						</tbody>
					</table>
					<div style="text-align: right">
						<button type="submit" name="submit" class="btn btn-primary">保存</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>