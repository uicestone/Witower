<? $this->view('header') ?>
<div class="page-wit">
	<div class="model">
		<div class="title"><h3>版本</h3></div>
		<form method="post" name="editionform">
			<div class="main">
				<table cellspacing="0" cellpadding="0" class="table w-950 l">
					<thead>
						<tr>
							<td style="width: 150px;">版本</td>
							<td style="width: 100px;">时间</td>
							<td style="width: 140px;">作者</td>

						</tr>
					</thead>
					<tbody>
<? foreach ($versions as $id => $version) { ?>
						<tr class="fields">
							<td>
								<input name="eid[]" value="<?= $version['id'] ?>" type="checkbox" /><input name="version_<?= $version['id'] ?>" value="" type="hidden" />
								<?=$id+1?>
							</td>
							<td class="gray"><?= date('Y-m-d',$version['time']) ?></td>
							<td><a href="/space/<?=$version['user']?>" ><?= $version['author_name'] ?></a>
							</td>
						</tr>
						<tr class="summary"><td colspan="3"><?= $version['content'] ?></td></tr>
<? } ?>
					</tbody>
				</table>
			</div>
			<div class="operation_btn">	
				<button type="button" class="btn" class="btn_inp"/>比较</button>
				<button type="submit" class="btn btn-primary" name="save_score" />保存分数</button>
			</div>
		</form>
	</div>
</div>

<? $this->view('footer') ?>
