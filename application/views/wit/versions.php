<? $this->view('header') ?>
<script type="text/javascript" src="/js/diff_match_patch.js"></script>
<script type="text/javascript" src="/js/jquery.pretty-text-diff.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.version').on('click',function(){
		$(this).siblings('.version:hidden').show().removeClass('changed')
		.siblings().removeClass('changed').removeClass('original')
		.siblings('.diff').remove();

		$(this).clone().insertBefore(this).addClass('diff');
		$(this).addClass('changed').hide()
			.nextAll('.version:first').addClass('original')
			.parent().prettyTextDiff({
				originalContainer:'.version.original>.content',
				changedContainer:'.version.changed>.content',
				diffContainer:'.version.diff>.content'
			})
			.children('.version.diff').children('.content').find('br:first').remove();
	});
	$('.version:first').trigger('click');
});
</script>
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
			版本 <?=$wit['name']?>
		</li>
	</ul>
	<div class="model">
		<div class="title"><h3>版本 <?=$wit['name']?></h3></div>
		<form method="post">
			<div class="main">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>版本</th>
							<th>标题</th>
							<th>作者</th>
							<th>时间</th>
<?if($this->user->isLogged(array('witower','wit')) || $project['company']==$this->user->id){?>
							<th>操作</th>
<?}?>
						</tr>
					</thead>
					<tbody>
<?foreach ($versions as $id => $version){?>
						<tr class="fields">
							<td>
								<label>
									<?=$version['num']?>
<?	if($version['deleted']){?>
									<span class="icon-remove-sign" title="已删除"></span>
<?	}?>
								</label>
							</td>
							<td><?=$version['name']?></td>
							<td>
								<a href="/space/<?=$version['user']?>" ><?= $version['author_name'] ?></a>
							</td>
							<td>
								<?= date('Y-m-d H:i',$version['time']) ?>
							</td>
<?	if($this->user->isLogged(array('witower','wit')) || $project['company']==$this->user->id){?>
							<td>
<?		if($version['deleted']){?>
								<a href="/wit/recoverversion/<?=$version['id']?>" class="btn btn-small">恢复</a>
<?		}else{?>
								<a href="/wit/removeversion/<?=$version['id']?>" class="btn btn-small">删除</a>
<?		}?>								
							</td>
<?	}?>
						</tr>
						<tr class="summary version">
							<td class="content" colspan="<?if($this->user->isLogged(array('witower','wit')) || $project['company']==$this->user->id){?>5<?}else{?>4<?}?>">
								<?= $version['content'] ?>
							</td>
						</tr>
<?}?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<? $this->view('footer') ?>
