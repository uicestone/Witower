<? $this->view('header') ?>
<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
$(function(){
	tinymce.init({
		selector: 'textarea.tinymce',
		language: 'zh_CN'
	});
});
</script>
<div id="content" class="page-witedit model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">项目</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/project/<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="#">编辑创意</a>
		</li>
	</ul>
	<div id="left">
		<div class="model model-b">
			<div class="main">
				<form method="post">
					<div class="control-group">
						<div class="controls">
							<input type="text" name="name" placeholder="创意标题" value="<?=$wit['name']?>" style="width: 696px;" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<textarea name="content" rows="20" class="tinymce" placeholder="创意内容" style="width: 696px;"><?=$wit['content']?></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" name="submit" class="btn btn-primary">提交</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?$this->view('wit/sidebar')?></div>
<? $this->view('footer') ?>
