<? $this->view('header') ?>
<script type="text/javascript" src="/js/diff_match_patch.js"></script>
<script type="text/javascript" src="/js/jquery.pretty-text-diff.min.js"></script>
<script type="text/javascript">
$(function(){
	$('.detail').on('click',function(){
		$(this).siblings('.detail:hidden').show().removeClass('changed')
		.siblings().removeClass('changed').removeClass('original')
		.siblings('.diff').remove();

		$(this).clone().insertAfter(this).addClass('diff');
		$(this).addClass('changed').hide()
			.prev().addClass('original')
			.parent().prettyTextDiff({
				originalContainer:'.detail.original>.content',
				changedContainer:'.detail.changed>.content',
				diffContainer:'.detail.diff>.content'
			})
			.children('.detail.diff').children('.content').find('br:first').remove();
	});
	$('.detail:last').trigger('click');
});
</script>
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
			版本比较 <?if(isset($wit)){?><?=$wit['name']?><?}?>
		</li>
	</ul>
	<div class="model model-b">
		<div class="title">
			<h3>版本比较 <?if(isset($wit)){?><?=$wit['name']?><?}?></h3>
<?if($this->project->getStatus($project['id'])==='buffering'){?>
<?	if($wit['selected']){?>
			<a href="/wit/unselect/<?=$wit['id']?>" class="btn btn-small" style="margin-left:1em">取消选中此创意</a>
<?	}else{?>
			<a href="/wit/select/<?=$wit['id']?>" class="btn btn-small" style="margin-left:1em">选中此创意</a>
<?	}?>
<?}?>
		</div>
		<div class="main" style="overflow:scroll">
			<?$this->view('alert')?>
<?foreach($versions as $version){?>
			<div class="detail" style="width:48%;float:left;padding:1%;">
				<div class="title">
					<?=$version['name']?>
				</div>
				<div class="author">
					<?=$version['username']?>
					<?=date('Y-m-d H:i',$version['time'])?>
				</div>
				<div class="content">
					<?=$version['content']?>
				</div>
				<div class="score" style="margin-top: 10px; border-top: #888 dotted 1px;">
					<form method="post" class="form form-inline" style="padding:5px;">
						<input type="text" name="score[<?=$version['id']?>]" value="<?=$version['score']?>" placeholder="评分" style="width:3em">
						<input type="text" name="comment[<?=$version['id']?>]" value="<?=$version['comment']?>" placeholder="评语">
						<button type="submit" class="btn">打分</button>
					</form>
				</div>
			</div>
<?}?>
		</div>
	</div>
</div>
<?$this->view('footer')?>