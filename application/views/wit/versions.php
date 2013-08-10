<? $this->view('header') ?>
<div class="page-wit">
	<ul class="breadcrumb">
		<li>
			<strong><a href="/project">项目</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/project/view/<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
		<li>
			<?=$wit['name']?>
			<span class="divider">/</span>
		</li>
		<li>
			版本
		</li>
	</ul>
	<div class="model">
		<div class="title"><h3>版本</h3></div>
		<form method="post">
			<div class="main">
				<table cellspacing="0" cellpadding="0" class="table w-950 l">
					<thead>
						<tr>
							<th>版本</th>
							<th>时间</th>
							<th>作者</th>
<?if($this->user->isLogged('wit')){?>
							<th>操作</th>
<?}?>
						</tr>
					</thead>
					<tbody>
<?foreach ($versions as $id => $version){?>
						<tr class="fields">
							<td>
								<label>
									<input name="versions[]" value="<?=$version['num'] ?>" type="checkbox" />
									<?=$version['num']?>
								</label>
							</td>
							<td><?= date('Y-m-d H:i:s',$version['time']) ?></td>
							<td><a href="/space/<?=$version['user']?>" ><?= $version['author_name'] ?></a></td>
<?	if($this->user->isLogged('wit')){?>
							<td>
								<a href="/wit/removeversion/<?=$version['id']?>" class="btn btn-small">删除</a>
							</td>
<?	}?>
						</tr>
						<tr class="summary">
							<td colspan="<?if($this->user->isLogged('wit')){?>4<?}else{?>3<?}?>">
								<?= $version['content'] ?>
							</td>
						</tr>
<?}?>
					</tbody>
				</table>
				<div style="padding:0 0 1em 1em">
					<button type="button" class="btn btn-primary">比较</button>
				</div>
			</div>
		</form>
	</div>
</div>

<? $this->view('footer') ?>
