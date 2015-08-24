<?$this->view('header')?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><?if(isset($finance['id'])){?>查看帐目<?}else{?>添加帐目<?}?></h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" method="post">
						<div class="control-group">
							<label class="control-label">日期</label>
							<div class="controls">
								<input type="text" name="date" value="<?=set_value('date',$finance['date'])?>">
								<span class="label label-important"><?=form_error('date')?></span>
								<input type="text" name="time" value="<?=set_value('time',$finance['time'])?>">
								<span class="label label-important"><?=form_error('time')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">用户</label>
							<div class="controls">
								<input type="text" name="username" value="<?=set_value('username',$finance['username'])?>" data-id-element="[name='user']" autocomplete="off">
								<input type="hidden" name="user" value="<?=set_value('user',$finance['user'])?>">
								<span class="label label-important"><?=form_error('username')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目</label>
							<div class="controls">
								<input type="text" name="project_name" value="<?=set_value('project_name',$finance['project_name'])?>" data-id-element="[name='project']" autocomplete="off">
								<input type="hidden" name="project" value="<?=set_value('project',$finance['project'])?>">
								<span class="label label-important"><?=form_error('project_name')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">金额</label>
							<div class="controls">
								<input type="text" name="amount" value="<?=set_value('amount',$finance['amount'])?>">
								<span class="label label-important"><?=form_error('amount')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">科目</label>
							<div class="controls">
								<input type="text" name="item" value="<?=set_value('item',$finance['item'])?>">
								<span class="label label-important"><?=form_error('item')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">摘要</label>
							<div class="controls">
								<textarea rows="4" name="summary"><?=set_value('summary',$finance['summary'])?></textarea>
							</div>
						</div>
<?if(empty($finance['id'])){?>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">保存</button>
							</div>
						</div>
<?}?>
					</form>
				</div>
			</div>
		</div>
	</div>

<link rel="stylesheet" type="text/css" href="/style/bootstrap/typeahead.js-bootstrap.css">
<script type="text/javascript" src="/js/typeahead.min.js"></script>
<script type="text/javascript">
$(function(){
	
	$(':input[name="date"]').datepicker({
		language:'zh-CN',
		forceParse:false
	});
	
	$(':input[name="username"]').typeahead({
		remote: '/user/match/%QUERY',
		valueKey:'name'
	});
	
	$(':input[name="project_name"]').typeahead({
		remote: '/project/match/%QUERY',
		valueKey:'name'
	});
	
	$(':input[name="item"]').typeahead({
		remote: '/finance/matchitems/%QUERY',
		valueKey:'name'
	});
	
	$(':input').on('typeahead:selected',function(event,item){
		console.log('selected');
		$($(this).data('id-element')).val(item.id);
	})
	.on('change',function(event){
		if($(this).val()==='' && $(this).data('id-element')){
			$($(this).data('id-element')).val('');
		}
	});
	
});
</script>

<?$this->view('footer')?>