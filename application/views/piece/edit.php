<?php $this->view('header'); ?>
<link rel="stylesheet" href="<?=site_url()?>style/jquery.fileupload.css">
<!--<link rel="stylesheet" href="<?=site_url()?>style/jquery.fileupload-ui.css">-->
<div class="span12">
	<?php $this->view('alert'); ?>
	<div class="model model-b">
		<div class="main">
			<form method="post">
				<legend>上传作品</legend>
				<label>标题：</label>
				<input type="text" name="name" value="<?=set_value('name', $piece['name'])?>" class="input-block-level" />
				<label>项目：</label>
				<input type="text" id="project-name" value="<?=set_value('project_name',isset($piece['project_name']) ? $piece['project_name'] : null)?>" autocomplete="off" data-id-element="#project" class="input-block-level<?if(isset($piece['project_name'])){?> uneditable-input<?}?>">
				<input type="hidden" id="project" name="project" value="<?=set_value('project',$piece['project'])?>">
				<label style="margin-top:10px;">作品描述：</label>
				<textarea name="description" class="wysiwyg" style="min-height:7em"><?=set_value('description', $piece['description'])?></textarea>
				<label style="margin-top:10px">附件上传：</label>
				<span class="btn btn-success fileinput-button">
					<i class="fa fa-plus"></i>
					<span>选择文件</span>
					<input id="fileupload" type="file" name="files">
					<input type="hidden" id="files-template" name="files[]" disabled="disabled">
					<?php if(isset($piece['files']) && is_array($piece['files'])):foreach($piece['files'] as $file): ?>
					<input type="hidden" name="files[]" value='<?=json_encode($file, JSON_UNESCAPED_UNICODE)?>'>
					<?php endforeach;endif; ?>
					<input id="files-clearer" type="hidden" name="files" value="" disabled="disabled">
				</span>
				<button id="clear-files" type="button" class="btn btn-danger">清空</button>
				<ul id="files" class="thumbnails">
					<?php if(isset($piece['files']) && is_array($piece['files'])):foreach($piece['files'] as $file): ?>
					<li class="span4">
						<div class="thumbnail">
							<a href="<?=$file->url?>">
								<?php if(preg_match('/^image/', $file->file_type)){ ?>
								<img src="<?=$file->url?>">
								<?php }elseif(preg_match('/^video/', $file->file_type)){ ?>
								<img src="<?=site_url()?>style/video_icon.png">
								<?php } ?>
							</a>
							<h5><?=$file->client_name?></h5>
							<p></p>
						</div>
					</li>
					<?php endforeach;endif; ?>
				</ul>
				<div class="form-actions">
					<button type="submit" name="submit" class="btn btn-primary">提交</button>
					<?php if(isset($piece['id']) && $this->user->id === $piece['user'] || $this->user->isLogged('piece')){ ?>
					
					<a id="vote-button" href="#remove-confirm-modal" role="button" class="btn" data-toggle="modal">删除</a>

					<div id="remove-confirm-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4>确认投票</h4>
						</div>
						<div class="modal-body">
							确认删除"<?=$piece['name']?>"吗？
						</div>
						<div class="modal-footer">
							<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
							<button type="submit" name="remove" class="btn btn-danger">确认删除</button>
						</div>
					</div>	
					<?php } ?>
				</div>
			</form>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/style/bootstrap/typeahead.js-bootstrap.css">
<script type="text/javascript" src="/js/typeahead.min.js"></script>
<script type="text/javascript">
jQuery(function ($) {
	
	$('#project-name').typeahead({
		remote: '/project/match/%QUERY',
		valueKey:'name'
	});
	
	$(':input').on('typeahead:selected',function(event,item){
		$($(this).data('id-element')).val(item.id);
	})
	.on('change',function(event){
		if($(this).val()==='' && $(this).data('id-element')){
			$($(this).data('id-element')).val('');
		}
	});
	
	$('#clear-files').on('click', function(){
		$('#files-clearer').prop('disabled', false);
		$(':input[name="files[]"]').remove();
		$('#files').empty();
	});
	
	$('#fileupload').fileupload({
		url: '/media/upload'
//		dataType: 'json'
//		autoUpload: true,
//		disableImageResize: /Android(?!.*Chrome)|Opera/
////				.test(window.navigator.userAgent),
//		previewMaxWidth: 100,
//		previewMaxHeight: 100,
//		previewCrop: true
	})
	.on('fileuploadadd', function(e, data) {
		data.context = $('<li class="span4"><div class="thumbnail"><img src="/uploads/images/product/0.jpg" alt=""><h5></h5><p></p></div></li>')
			.appendTo('#files').find('h5').text(data.files[0].name).end().find('img').attr('alt', data.files[0].name).end();
	})
	.on('fileuploaddone', function(e, response) {
		if (response.result.url) {
			var link = $('<a>')
				.attr('target', '_blank')
				.prop('href', response.result.url);

			response.context
				.find('h5').wrapInner(link).end()
				.find('img').wrap(link);
		
			$('#files-template').clone().val(JSON.stringify(response.result)).prop('disabled', false).removeAttr('id').insertAfter('#files-template');
			
			$('#files-clearer').prop('disabled', true);
			
		}
	})
/*	.on('fileuploadprocessalways', function(e, data) {
		console.log('process always', data);
		var index = data.index,
				file = data.files[index],
				node = $(data.context.children()[index]);
		if (file.preview) {
			node
					.prepend('<br>')
					.prepend(file.preview);
		}
		if (file.error) {
			node
					.append('<br>')
					.append($('<span class="text-danger"/>').text(file.error));
		}
		if (index + 1 === data.files.length) {
			data.context.find('button')
					.text('上传')
					.prop('disabled', !!data.files.error);
		}
	})
	.on('fileuploadprogressall', function(e, data) {
		console.log('progress all', data);
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$('#progress .progress-bar').css('width', progress + '%');
	})*/
//		else if (response.result.files[0].error) {
//			var error = $('<span class="text-danger"/>').text(file.error);
//			response.context.append('<br>').append(error);
//		}
//	.on('fileuploadfail', function(e, data) {
//		
//		$.each(data.files, function(index) {
//			
//			var error = $('<span class="text-danger"/>').text('上传文件失败');
//			
//			$(data.context.children()[index]).append('<br>').append(error);
//		});
//	})
//	.prop('disabled', !$.support.fileInput)
//		.parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>

<?php $this->view('piece/sidebar'); ?>

<?php $this->view('footer'); ?>
