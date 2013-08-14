<?$this->view('header')?>
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
							<label class="control-label">开始日期</label>
							<div class="controls">
								<input type="text" name="start" value="<?=set_value('wit_start',$project['wit_start'])?>" title="保存后不能修改"<?if($project['bonus']){?> class="uneditable-input"<?}?>>
								<span class="label label-important"><?=form_error('wit_start')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">截止日期</label>
							<div class="controls">
								<input type="text" name="end" value="<?=set_value('wit_end',$project['wit_end'])?>" title="保存后不能修改"<?if($project['bonus']){?> class="uneditable-input"<?}?>>
								<span class="label label-important"><?=form_error('wit_end')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">悬赏金额</label>
							<div class="controls">
								<input type="text" name="bonus" value="<?=set_value('bonus',$project['bonus'])?>" placeholder="￥" title="保存后不能修改"<?if(isset($project['id'])){?> class="uneditable-input"<?}?>>
								<span class="label label-important"><?=form_error('bonus')?></span>
								<span class="label label-info" style="display:none">目前积分是 <?=$this->finance->sum(array('user'=>$project['company'],'item'=>'积分'))?> 元</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">关键词</label>
							<div class="controls">
								<input type="text" name="tags" value="<?=isset($tags)?implode(', ',$tags):''?>" />
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