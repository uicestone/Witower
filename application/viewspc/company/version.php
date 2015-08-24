<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3>版本</h3></div>
			<div class="main">
				<form action="/wit/versions/<?=$wit['id']?>">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th id="num" style="width:2em;">版本</th>
								<th id="name">创意标题</th>
<?if(!isset($project) && !isset($wit)){?>
								<th id="project">项目</th>
<?}?>
								<th id="content">内容</th>
								<th id="date">作者/时间</th>
								<th id="score">得分</th>
							</tr>
						</thead>
						<tbody>
							<? foreach ($versions as $version) { ?>
								<tr>
									<td id="num" style="text-align: center;">
										<input type="checkbox" name="versions[]" value="<?=$version['id']?>">
										<a href="/wit/<?=$version['wit']?>?version=<?=$version['num']?>" target="_blank"><?=$version['num']?>
									</td>
									<td id="name">
										<a href="/wit/<?=$version['wit']?>" target="_blank"><?=$version['wit_name']?></a>
										<?if(!isset($wit)){?><a href="/<?=uri_segment(1)?>/version?wit=<?=$version['wit']?>"><span class="icon-filter pull-right"></span></a><?}?>
									</td>
<?if(!isset($project) && !isset($wit)){?>
									<td id="project">
										<a href="/project/<?=$version['project']?>" target="_blank"><?=$version['project_name']?></a>
										<?if(!isset($project)){?><a href="/<?=uri_segment(1)?>/version?project=<?=$version['project']?>"><span class="icon-filter pull-right"></span></a><?}?>
									</td>
<?}?>
									<td id="content"><?=str_getSummary(strip_tags($version['content']),164)?></td>
									<td id="date">
										<p><?=$version['username']?></p>
										<p><?=date('Y-m-d', $version['time'])?></p>
									</td>
									<td id="score">
										<span title="智塔打分">智 <?=$version['score_witower']?></span>
										<br />
										<span title="企业打分">企 <?=$version['score_company']?></span>
									</td>
								</tr>
							<? } ?>								
						</tbody>
					</table>
					<button type="submit" class="btn btn-primary">比较</button>
				</form>
			</div>
		</div>
	</div>
<?$this->view('footer')?>