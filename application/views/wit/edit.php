<? $this->view('header') ?>
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/bootstrap/datepicker.css">
<link rel="stylesheet" href="//libs.baidu.com/fontawesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/summernote.css">
<script type="text/javascript" src="<?=site_url()?>js/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/bootstrap-wysiwyg.js"></script>
<link href="<?=base_url()?>style/fabuchuangyi.css" rel="stylesheet" type="text/css" />
<div class="indexDiv">
<? $this->view('alert') ?>
    <div class="heading2"><a href="">项目</a> / <a href=""><?= $project['name'] ?></a> / <a href=""><span>编辑创意</span></a></div>
			<form method="post">
				<div class="control-group">
					<div class="controls">
						<input type="text" name="name" placeholder="创意标题" value="<?=set_value('name', $wit['name'])?>" />
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<textarea name="content" class="wysiwyg"><?=set_value('content', $wit['content'])?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" name="submit" class="btn btn-primary">提交</button>
					</div>
				</div>
			</form>
</div>
<style>
#editor {width:100%;height:300px;}
#editor {overflow:scroll; max-height:300px;max-height: 250px;
  height: 250px;
  background-color: white;
  border-collapse: separate;
  border: 1px solid rgb(204, 204, 204);
  padding: 4px;
  box-sizing: content-box;
  -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
  box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-top-left-radius: 3px;
  overflow: scroll;
  outline: none;}
  .btn-group{display:none;}
  .note-insert{display:inherit;}
  .btn-default{   height: 30px; width: 40px;  margin-top: 0px;  margin-bottom: 0px;}
  .modal{ width: 80%;left: 10%;margin-left: 0px; }
  .note-editor{/*overflow: hidden;*/}
  .span3 {  width: 100%;  float: inherit;}
  h3 {font-size: 14px; }
  .btn {  display: inline;width: auto;  height: auto ;}
  .nav {  margin-bottom: 0px;}
  li{line-height: 45px;}
  ul{margin-bottom: 0px;margin-left: 0px;margin-right: 0px;}
</style>
<?$this->view('wit/sidebar')?>
<script>
$('#editor').wysiwyg();
function formSubmit(form){
	form.content.value = $('#editor').html();
	$('#myForm').submit();
}
</script>
		<script type="text/javascript" src="<?= site_url() ?>js/summernote.min.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/summernote-zh-CN.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.fileupload.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.iframe-transport.js"></script>
		<script type="text/javascript">
		jQuery(function($){
			$('.wysiwyg').summernote({
				lang: 'zh-CN',
				onImageUpload: function(files, editor, $editable) {
					$editable.parent('.note-editor').find('.note-image-input').fileupload({url: '/media/upload'})
						.fileupload('send', {files: files}).success(function(result){
							editor.insertImage($editable, result.url);
						});
					}
				});
			});
		</script>
<? $this->view('footer') ?>
