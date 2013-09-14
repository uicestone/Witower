<?$this->view('header')?>
<script type="text/javascript">
$(function(){
<?if(!$this->user->isLogged('witower')){?>	
	//创意征集结束时间在开始时间+6 - 开始时间+14的范围，即7-15天
	$('[name="wit_start"]').on('change',function(){
		var witEndValidFrom = new Date($(this).val());
		var witEndValidTo = new Date($(this).val());
		
		witEndValidFrom.setDate(witEndValidFrom.getDate()+6);
		witEndValidTo.setDate(witEndValidTo.getDate()+14);
		
		$('[name="wit_end"]').datepicker('setStartDate',witEndValidFrom).datepicker('setEndDate',witEndValidTo);
	});
	
	//投票评选日期开始为创意征集结束日期+2天
	$('[name="wit_end"]').on('change',function(){
		var voteStart = new Date(new Date($(this).val()).getTime() + 86400000 * 2);
		$('[name="vote_start"]').val(voteStart.getFullYear() + '-' + ('0' + (voteStart.getMonth() + 1)).slice(-2) + '-' + ('0' + voteStart.getDate()).slice(-2)).trigger('change');
	});
	
	//投票结束日期为投票开始日期+2天，即3天投票期
	$('[name="vote_start"]').on('change',function(){
		var voteEnd = new Date(new Date($(this).val()).getTime() + 86400000 * 2);
		$('[name="vote_end"]').val(voteEnd.getFullYear() + '-' + ('0' + (voteEnd.getMonth() + 1)).slice(-2) + '-' + ('0' + voteEnd.getDate()).slice(-2));
	});
	
	$('[name="wit_start"]').trigger('change');
<?}?>
});
</script>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/project">项目管理</a>
			<span class="divider">/</span>
		</li>
		<li>
			<?if(isset($project['id'])){?>编辑项目 <?=$project['name']?><?}else{?>添加项目<?}?>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><?if(isset($project['id'])){?>编辑项目 <?=$project['name']?><?}else{?>添加项目<?}?></h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label">项目名称</label>
							<div class="controls">
								<input type="text" name="name" value="<?=set_value('name',$project['name']);?>">
								<span class="label"><?=lang($project['status'])?></span>
								<span class="label label-important"><?=form_error('name')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">所属产品</label>
							<div class="controls">
								<select name="product">
									<?=options($products, $project['product'],'', true)?>
								</select>
								<span class="label label-important"><?=form_error('product')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目图片</label>
							<div class="controls">
								<?=$this->image('project',isset($project['id'])?$project['id']:NULL,200,220)?>
								<br>
								<input type="file" name="image">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目描述</label>
							<div class="controls">
								<textarea rows="4" name="summary"><?=set_value('summary',$project['summary'])?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">创意征集</label>
							<div class="controls">
								<input type="text" class="datepicker" name="wit_start" value="<?=set_value('wit_start',$project['wit_start'])?>" title="项目开始后不能修改"<?if(isset($project['id']) && $project['status']!=='preparing' && uri_segment(1)!=='admin'){?> readonly="readonly"<?}?> data-startdate="<?=date('Y-m-d')?>"<?if(uri_segment(1)==='admin'){?> data-date-range-unlimited="1"<?}?>>
								<input type="text" class="datepicker" name="wit_end" value="<?=set_value('wit_end',$project['wit_end'])?>" title="项目开始后不能修改"<?if(isset($project['id']) && $project['status']!=='preparing' && uri_segment(1)!=='admin'){?> readonly="readonly"<?}?><?if(uri_segment(1)==='admin'){?> data-date-range-unlimited="1"<?}?>>
								<span class="label label-important"><?=form_error('wit_start')?></span>
								<span class="label label-important"><?=form_error('wit_end')?></span>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">投票评选</label>
							<div class="controls">
								<input type="text" class="datepicker" name="vote_start" value="<?=set_value('vote_start',$project['vote_start'])?>"<?if(uri_segment(1)!=='admin'){?> readonly="readonly"<?}?><?if(uri_segment(1)==='admin'){?> data-date-range-unlimited="1"<?}?>>
								<input type="text" class="datepicker" name="vote_end" value="<?=set_value('vote_end',$project['vote_end'])?>"<?if(uri_segment(1)!=='admin'){?> readonly="readonly"<?}?><?if(uri_segment(1)==='admin'){?> data-date-range-unlimited="1"<?}?>>
								<span class="label label-important"><?=form_error('vote_start')?></span>
								<span class="label label-important"><?=form_error('vote_end')?></span>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">悬赏金额</label>
							<div class="controls">
								<input type="text" name="bonus" value="<?=set_value('bonus',$project['bonus'])?>" placeholder="￥" title="保存后不能修改"<?if(isset($project['id'])){?> readonly="readonly"<?}?>>
								<span class="label label-important"><?=form_error('bonus')?></span>
								<span class="label label-info" style="display:none">目前积分是 <?=$this->finance->sum(array('user'=>$project['company'],'item'=>'积分'))?> 元</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">关键词</label>
							<div class="controls">
								<input type="text" name="tags" value="<?=set_value('tags',isset($tags)?implode(', ',$tags):'')?>" />
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">保存</button>
<?if(uri_segment(1)==='admin' && isset($project['id'])){?>
<?	if($project['status']==='voting'){?>
								<a href="/project/end/<?=$project['id']?>" class="btn btn-danger">结束</a>
<?	}?>
								<a href="/admin/finance?project=<?=$project['id']?>" class="btn">财务</a>
<?}?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>